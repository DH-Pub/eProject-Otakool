<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use App\Models\Promotion;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function MyCart()
    {
        $custCart = null;
        $orderdetails = null;
        $listPrice = null;
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();
            $custCart = Order::where([
                ['cust_id', $customer->id],
                ['status', 'cart'],
            ])->first();
            if ($custCart) {
                $orderdetails = Orderdetail::where([
                    ['o_id', $custCart->id],
                ])->orderBy('created_at', 'asc')->with('products')->get();
                foreach ($orderdetails as $od) {
                    $listPrice += $od->products->price * $od->quantity;
                }
            }
        }
        return view('fe.my_cart.view_my_cart', compact('orderdetails', 'custCart', 'listPrice'));
    }

    public function addToCart(Request $request, $pId)
    {
        if (!Auth::guard('customer')->check()) {
            return redirect()->route('customer.login')->with('error', 'Please log in to purchase');
        }
        $customer = Auth::guard('customer')->user();
        $p = Product::where('id', $pId)->first();

        $promo = Promotion::whereRaw("? between start and end", [date('Y-m-d')])->where("applied_products", "LIKE", "%" . $pId . "%")->first();
        if (isset($promo)) {
            if ($promo->type == 0) {
                $priceDiscounted = $p->price - $promo->amount;
            } elseif ($promo->type == 1) {
                $priceDiscounted = $p->price * (1 - $promo->amount / 100);
            }
            $price = round($priceDiscounted, 2);
        } else {
            $promo = null;
            $price = $p->price;
        }

        $quantity = $request['quantity'];
        if ($quantity > $p->quantity) {
            return back();
        }

        // Check cart
        $custCart = Order::where([
            ['cust_id', $customer->id],
            ['status', 'cart'],
        ])->first();
        if (isset($custCart)) { // if customer already has cart
            $repeatOrder = Orderdetail::with('orders')->where([
                ['p_id', $p->id],
                ['o_id', $custCart->id],
            ])->first();
            if (isset($repeatOrder)) {
                $orderdetails = $repeatOrder;
                $orderdetails->quantity += $quantity;
            } else {
                $orderdetails = new Orderdetail($request->all());
            }
        } else {
            $orderdetails = new Orderdetail($request->all());
            $custCart = new Order();
            $custCart->cust_id = $customer->id;
            $custCart->save(); //generate cart id first  with customer id

            $orderdetails->o_id = $custCart->id;
        }

        $orderdetails->price = $price;
        $orderdetails->p_id = $p->id;
        $orderdetails->o_id = $custCart->id;

        $orderdetails->save();

        $p->quantity -= $quantity;
        $p->save();

        $this->updateCartPrice($custCart->id); // update cart price

        return redirect()->route('mycart');
    }

    public function itemRemove($id)
    {
        $od = Orderdetail::find($id);
        $p = Product::find($od->p_id);
        $p->quantity += $od->quantity;
        $od->delete();

        $this->updateCartPrice($od->o_id);
        $order = Order::find($od->o_id);
        $cartEmpty = Orderdetail::where('o_id', $order->id)->first();
        if (!isset($cartEmpty)) {
            $order->delete();
        }
        $p->save();

        return back();
    }

    // Update cart
    public function updateCartPrice($oid)
    {
        $custCart = Order::find($oid);
        $price = 0;
        $orderdetails = Orderdetail::where('o_id', $oid)->get();
        foreach ($orderdetails as $od) {
            $price += $od->price * $od->quantity;
        }

        $custCart->price = $price;
        $custCart->save();
    }
    // ------------------

    // Check out
    public function Checkout($id)
    {
        // check authenticate customer logged in or not
        if (!Auth::guard('customer')->check()) {
            $notification = array(
                'message' => 'Please Login First',
                'alert-type' => 'error'
            );
            return redirect()->route('customer.login')->with($notification);
        }

        $cart = Order::where('id', $id)->with('customers')->first();
        if (Auth::guard('customer')->user()->id == $cart->cust_id) {
            $orderdetails = Orderdetail::where('o_id', $cart->id)->get();
            return view('fe.checkout.view_checkout', compact('cart', 'orderdetails'));
        } else {
            return redirect()->route('index');
        }
    }

    public function CheckoutComplete(Request $request, $id)
    {
        $validateData = $request->validate([
            'address' => 'required',
            'contact' => 'required',
        ], [
            'address' => 'Address is required',
            'contact' => 'Contact is required',
        ]);
        $order = $request->all();
        $cart = Order::where('id', $id)->first();
        if (Auth::guard('customer')->user()->id != $cart->cust_id) {
            return back();
        }
        $cart->status = 'pending';
        $cart->address = $order['address'];
        $cart->contact = $order['contact'];
        $cart->note = $order['note'];
        $cart->save();
        return view('fe.checkout.checkout-complete');
    }
}
