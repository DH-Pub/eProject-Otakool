<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CommentController extends Controller
{
    // FE
    public function commentPost(Request $request, $pId)
    {
        $validateData = $request->validate([
            'rate' => 'required',
        ], [
            'rate.required' => 'Please chose a rating',
        ]);
        $customer = Auth::guard('customer')->user();
        $commentExist = Comment::where([
            ['cust_id', $customer->id],
            ['p_id', $pId]
        ])->first();
        if ($commentExist !== null) {
            return back();
        }
        $comment = $request->all();
        $c = new Comment($comment);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $name = str_replace(
                    pathinfo($name, PATHINFO_FILENAME),
                    uniqid('', true),
                    $name
                );

                $image->move('images/comments/', $name);
                $data[] = $name;
            }
            $c->images = json_encode($data);
        } else {
            $c->images = null;
        }

        $c->p_id = $pId;
        $c->cust_id = $customer->id;
        $c->save();
        return back();
    }

    public function commentEdit(Request $request, $id)
    {
        $comment = $request->all();
        $c = Comment::find($id);
        if (Auth::guard('customer')->user()->id != $c->cust_id) {
            return back();
        }
        if ($request->hasFile('images')) {
            if (isset($c->images)) {
                $images = json_decode($c->images);
                foreach ($images as $image) {
                    File::delete('images/comments/' . $image);
                }
            }

            foreach ($request->file('images') as $image) {
                $name = $image->getClientOriginalName();
                $name = str_replace(
                    pathinfo($name, PATHINFO_FILENAME),
                    uniqid('', true),
                    $name
                );

                $image->move('images/comments/', $name);
                $data[] = $name;
            }
            $c->images = json_encode($data);
        }
        $c->rate = $comment['rate'];
        $c->title = $comment['title'];
        $c->content = $comment['content'];
        $c->save();
        return back();
    }

    public function commentDelete($id)
    {
        $c = Comment::find($id);
        if (isset($c->images)) {
            $images = json_decode($c->images);
            foreach ($images as $image) {
                File::delete('images/comments/' . $image);
            }
        }
        $c->delete();
        return back();
    }

    // BE
    public function comment()
    {
        $comments = Comment::with('customers', 'products')->get();
        return view('be.comment.index', compact('comments'));
    }

    public function delete($id)
    {
        $c = Comment::find($id);
        if (isset($c->images)) {
            $images = json_decode($c->images);
            foreach ($images as $image) {
                File::delete('images/comments/' . $image);
            }
        }
        $c->delete();
        return redirect()->route('be.comment');
    }
}
