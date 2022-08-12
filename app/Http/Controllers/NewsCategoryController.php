<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;

class NewsCategoryController extends Controller
{
    // BE
    public function index(){
        $newsCategory = NewsCategory::latest()->get();
        return view('be.news_category.index',compact('newsCategory'));
    }

    public function createNewsCategory(){
        return view('be.news_category.create');
    }

    public function postNewsCategory(Request $request){
        $validateData = $request->validate([
            'news_category' => 'required|string|min:3|max:64',
        ], [
            'news_category.required' => 'News category is required.',
            'news_category.min' => 'News category must be at least 3 characters.',
            'news_category.max' => 'News category must be at most 64 characters.',
        ]);

        $categoryExist = NewsCategory::where([
            ['news_category', '=', $request->news_category],
        ])->first();
        if ($categoryExist !== null) {
            return redirect()->back()->with('categoryErr', 'This news category already exists.')->withInput();
        }

        $n = new NewsCategory($request->all());
        $n->save();

        $notification = array(
           'message' => 'News Category Created Successfully', 
           'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function detailsNewsCategory($id){
        $data = NewsCategory::find($id);
        return view('be.news_category.details',compact('data'));
    }

    public function editNewsCategory($id){
        $editData = NewsCategory::find($id);
        return view('be.news_category.edit',compact('editData'));
    }

    public function updateNewsCategory(Request $request,$id){
        $validateData = $request->validate([
            'news_category' => 'required|string|min:3|max:64',
        ], [
            'news_category.required' => 'News category is required.',
            'news_category.min' => 'News category must be at least 3 characters.',
            'news_category.max' => 'News category must be at most 64 characters.',
        ]);

        $data = NewsCategory::find($id);

        $categoryExist = NewsCategory::where([
            ['id', '!=', $id],
            ['news_category', '=', $request->news_category],
        ])->first();
        if ($categoryExist !== null) {
            return redirect()->back()->with('categoryErr', 'This news category already exists.')->withInput();
        }

        $data->news_category = $request->news_category;
        $data->save();

        $notification = array(
           'message' => 'News Category Updated Successfully', 
           'alert-type' => 'success'
        );
        return redirect()->route('be.details.news.category',$data->id)->with($notification);
    }

    public function deleteNewsCategory($id)
    {
        $n = NewsCategory::find($id);
        $n->delete('');
        return back();
    }
}
