<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use App\Models\Promotion;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OtakoolController extends Controller
{
    public function index()
    {
        $promotions = Promotion::whereRaw(
            "? between start and end",
            [date('Y-m-d')]
        )->get();
        $products = Product::where([
            ['status', '!=', '-1'],
        ])->with('comments') // create temporary column averageRating
            ->leftJoin('comments', 'comments.p_id', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(comments.rate) as averageRating')
            ])->groupBy('products.id', 'products.name', 'products.price', 'products.description', 'products.release', 'products.quantity', 'products.status', 'products.type', 'products.tags', 'products.folder', 'products.cover', 'products.images', 'products.created_at', 'products.updated_at');
        // Latest Product
        $latest = $products;
        $latest = $latest->where([
            ['release', '<=', [date('Y-m-d')]],
        ])->orderBy('release', 'DESC')->take(5)->get();

        // Special offers
        $offers = $products;
        if ($promotions->count()) {
            // !$promotions->isEmpty()
            foreach ($promotions as $promo) {
                $applies[] = $promo->applied_products;
            }
            $applies = implode(",", $applies);
        } else {
            $applies = null;
        }
        $offers = $offers->whereRaw(
            "? LIKE CONCAT('%', `products`.`id`, '%')",
            [$applies]
        )->orderBy('release', 'DESC')->take(5)->get();

        return view('fe.app.index', compact('offers', 'latest', 'promotions'));
    }

    // Products -------------------------------
    public function productShow(Request $request, $productType = null)
    {
        switch ($productType) {
            case 'manga':
                $type = 'manga';
                break;
            case 'anime':
                $type = 'anime-disc';
                break;
            case 'figures':
                $type = 'figure';
                break;
            case 'merchandise';
                $type = 'merchandise';
                break;
            default:
                $type = null;
        }

        $search = $request->search;
        $products = Product::where([
            ['type', $type],
            ['status', '!=', '-1'],
            ['name', 'LIKE', '%' . $search . '%'],
        ])->with('comments') // create temporary column averageRating
            ->leftJoin('comments', 'comments.p_id', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(comments.rate) as averageRating')
            ])->groupBy('products.id', 'products.name', 'products.price', 'products.description', 'products.release', 'products.quantity', 'products.status', 'products.type', 'products.tags', 'products.folder', 'products.cover', 'products.images', 'products.created_at', 'products.updated_at');

        // Promotion --------------------------------------
        $promotions = Promotion::whereRaw(
            "? between start and end",
            [date('Y-m-d')]
        )->get();
        //  -------------------------------------------

        // sort
        if ($request->has('name')) {
            $products = $products->orderBy('name', $request->name);
        } elseif ($request->has('release')) {
            $products = $products->orderBy('release', $request->release);
        } elseif ($request->has('rate')) {
            $products = $products->orderBy('averageRating', $request->rate);
        } else {
            $products = $products->orderBy('created_at', 'DESC');
        }
        // ------------------------

        if ($request->has('tag')) {
            $products = $products->where('tags', 'LIKE', '%' . $request->tag . '%');
        }
        $products = $products->paginate(9)->appends([
            'tag' => $request->tag,
            'name' => $request->name,
            'release' => $request->release,
            'rate' => $request->rate,
        ]);

        return view('fe.app.product.' . $productType, compact('products', 'promotions'));
    }

    public function searchProduct(Request $request)
    {
        $search = $request['query'];
        $products = Product::where([
            ['status', '!=', '-1'],
            ['name', 'LIKE', '%' . $search . '%'],
        ])->with('comments')
            ->leftJoin('comments', 'comments.p_id', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(comments.rate) as averageRating')
            ])->groupBy('products.id', 'products.name', 'products.price', 'products.description', 'products.release', 'products.quantity', 'products.status', 'products.type', 'products.tags', 'products.folder', 'products.cover', 'products.images', 'products.created_at', 'products.updated_at');

        $promotions = Promotion::whereRaw(
            "? between start and end",
            [date('Y-m-d')]
        )->get();

        if ($request->has('name')) {
            $products = $products->orderBy('name', $request->name);
        } elseif ($request->has('release')) {
            $products = $products->orderBy('release', $request->release);
        } elseif ($request->has('rate')) {
            $products = $products->orderBy('averageRating', $request->rate);
        } else {
            $products = $products->orderBy('created_at', 'DESC');
        }

        $products = $products->paginate(9)->appends([
            'name' => $request->name,
            'release' => $request->release,
            'rate' => $request->rate,
        ]);

        return view('fe.app.product.search', compact('products', 'promotions'));
    }

    public function promotion(Request $request)
    {
        $search = $request->search;
        $promotions = Promotion::whereRaw(
            "? between start and end",
            [date('Y-m-d')]
        )->get();

        if ($promotions->count()) {
            // !$promotions->isEmpty()
            foreach ($promotions as $promo) {
                $applies[] = $promo->applied_products;
            }
            $applies = implode(",", $applies);
        } else {
            $applies = null;
        }

        $products = Product::whereRaw(
            "? LIKE CONCAT('%', `products`.`id`, '%')",
            [$applies]
        )->where([
            ['status', '!=', '-1'],
            ['name', 'LIKE', '%' . $search . '%'],
        ])->with('comments')
            ->leftJoin('comments', 'comments.p_id', 'products.id')
            ->select([
                'products.*',
                DB::raw('AVG(comments.rate) as averageRating')
            ])->groupBy('products.id', 'products.name', 'products.price', 'products.description', 'products.release', 'products.quantity', 'products.status', 'products.type', 'products.tags', 'products.folder', 'products.cover', 'products.images', 'products.created_at', 'products.updated_at');

        if ($request->has('name')) {
            $products = $products->orderBy('name', $request->name);
        } elseif ($request->has('release')) {
            $products = $products->orderBy('release', $request->release);
        } elseif ($request->has('rate')) {
            $products = $products->orderBy('averageRating', $request->rate);
        } else {
            $products = $products->orderBy('created_at', 'DESC');
        }

        $products = $products->paginate(9)->appends([
            'name' => $request->name,
            'release' => $request->release,
            'rate' => $request->rate,
        ]);

        return view('fe.app.product.promotion', compact('products', 'promotions'));
    }

    // Details ---------------------------------------------------
    public function details($id)
    {
        $p = Product::find($id);
        $images = (isset($p->images)) ? json_decode($p->images) : null;

        // promotion
        // $promotions = Promotion::whereRaw(
        //     "? between start and end",
        //     [date('Y-m-d')]
        // )->get();
        $promo = Promotion::whereRaw("? between start and end", [date('Y-m-d')])->where("applied_products", "LIKE", "%" . $id . "%")->first();
        if (isset($promo)) {
            if ($promo->type == 0) {
                $priceDiscounted = $p->price - $promo->amount;
            } elseif ($promo->type == 1) {
                $priceDiscounted = $p->price * (1 - $promo->amount / 100);
            }
            $priceDiscounted = round($priceDiscounted, 2);
        } else {
            $promo = null;
            $priceDiscounted = null;
        }

        // comment
        $comments = Comment::where('p_id', $id)->orderBy('created_at', 'desc')->with('customers:id,username'); // get customer column id and username only
        $commentRates = Comment::where('p_id', $id)->get();
        $totalComments = Comment::where('p_id', $id)->count();
        $averageRating = round($comments->avg('rate'), 1);

        $customer = null;
        $custComment = null;
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user();

            $custComment = Comment::where([
                ['p_id', $id],
                ['cust_id', $customer->id],
            ])->first();

            $comments = $comments->where('cust_id', '!=', $customer->id);
        }
        $comments = $comments->paginate(5);

        return  view('fe.app.product.details', compact(
            'p',
            'images',
            'comments',
            'commentRates',
            'totalComments',
            'averageRating',
            'customer',
            'custComment',
            'promo',
            'priceDiscounted'
        ));
    }
    // ------------------------------------------


}
