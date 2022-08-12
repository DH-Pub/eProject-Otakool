<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        $orders = Order::whereNotIn('status', ['cart', 'canceled'])->with('orderdetails', 'customers')->get();
        return view('be.order.index', compact('orders'));
    }

    public function details($id)
    {
        $o = Order::where('id', $id)->with('customers')->first();
        $orderdetails = Orderdetail::where('o_id', $id)->with('products')->get();
        return view('be.order.details', compact('o', 'orderdetails'));
    }

    public function edit($id)
    {
        $o = Order::where('id', $id)->with('customers')->first();
        $orderdetails = Orderdetail::where('o_id', $id)->with('products')->get();
        return view('be.order.edit', compact('o', 'orderdetails'));
    }

    public function editPost(Request $request, $id)
    {
        $o = Order::find($id);
        $o->status = $request['status'];
        $o->save();
        return redirect()->route('be.order.details', $o->id);
    }

    public function cancel($id)
    {
        $o = Order::find($id);
        $o->status = 'canceled';
        $o->save();
        $orderdetails = Orderdetail::where('o_id', $id)->get();
        foreach ($orderdetails as $od) {
            $p = Product::find($od->p_id);
            $p->quantity += $od->quantity;
            $p->save();
        }
        return back();
    }

    public function canceled()
    {
        $orders = Order::where('status', 'canceled')->with('orderdetails', 'customers')->get();
        return view('be.order.index', compact('orders'));
    }

    public function income()
    {
        $orders = Order::where('status', 'delivered')->orderBy('updated_at', 'desc')->get();
        return view('be.order.income', compact('orders'));
    }

    public function PrintInvoice($id){
        $invoice = Order::with('customers','products')->find($id);
        return view('be.order.print_invoice', compact('invoice'));
    }
}
