<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;

use App\Http\Requests\PromotionRequest;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function promotion()
    {
        $promotions = Promotion::all();
        return view('be.promotion.index', compact('promotions'));
    }

    public function create()
    {
        return view('be.promotion.create');
    }

    public function createPost(PromotionRequest $request)
    {
        $promotion = $request->all();
        $promo = new Promotion($promotion);

        if ($promo->type == 1 && $promo->amount > 90) {
            return back()->with('amount_err', 'Amount cannot be more than 90 for percentage')->withInput();
        }

        $promo->save();
        return redirect()->route('be.promotion');
    }

    public function details($id)
    {
        $promo = Promotion::find($id);
        $products = Product::whereRaw(
            "? LIKE CONCAT('%', `id`, '%')",
            [$promo->applied_products]
        )->get();
        return view('be.promotion.details', compact('promo', 'products'));
    }

    public function edit($id)
    {
        $promo = Promotion::find($id);
        $products = Product::whereRaw(
            "? LIKE CONCAT('%', `id`, '%')",
            [$promo->applied_products]
        )->get();
        return view('be.promotion.edit', compact('promo', 'products'));
    }
    public function editPost(PromotionRequest $request, $id)
    {
        $promotion = $request->all();
        $promo = Promotion::find($id);

        if ($promotion['type'] == 1 && $promotion['amount'] > 90) {
            return back()->with('amount_err', 'Amount cannot be more than 90 for percentage')->withInput();
        }
        $promo->name = $promotion['name'];
        $promo->description = $promotion['description'];
        $promo->type = $promotion['type'];
        $promo->amount = $promotion['amount'];
        $promo->start = $promotion['start'];
        $promo->end = $promotion['end'];
        $promo->applied_products = $promotion['applied_products'];
        $promo->save();
        return redirect()->route('be.promotion.details', $id);
    }

    public function delete($id)
    {
        $promo = Promotion::find($id);
        $promo->delete();
        return redirect()->route('be.promotion');
    }
}
