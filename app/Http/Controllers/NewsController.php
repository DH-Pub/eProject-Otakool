<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    // BE
     public function index(){
        $news = News::with('category')->get();
        return view('be.news.index',compact('news'));
    }

    public function createNews(){
        $categories = NewsCategory::orderBy('news_category','ASC')->get();
        return view('be.news.create',compact('categories'));
    }

    public function postNews(Request $request) {
        $request->validate([
            'news_category_id' => 'required',
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image'=>'required|file|image|mimes:jpeg,jpg,png,bmp,webp|max:10240',
        ], [
            'news_category_id.required' => 'News category is required.',

            'title.required' => 'News title is required.',
            'title.min' => 'News title must be at least 3 characters.',
            'title.max' => 'News title must be at most 255 characters.',

            'image.required'=>'New image is required.',
            'image.image'=>'The file uploaded must be an image file.',
            'image.mimes'=>'The images uploaded can only be a jpeg, jpg, png, bmp, or webp file.',
            'image.max'=>'News image must be maximum 10MB.',
        ]);

        $n = new News($request->all());

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imageName = str_replace(
                pathinfo($imageName, PATHINFO_FILENAME),
                uniqid(),
                $imageName
            );

            $file->move('images/news', $imageName);
        } else {
            $imageName = null;
        }
        $n->image = $imageName;

        $titleExist = News::where([
            ['title', '=', $request->title],
        ])->first();
        if ($titleExist !== null) {
            return redirect()->back()->with('titleErr', 'This title already exists.')->withInput();
        }

        $contentExist = News::where([
            ['content', '=', $request->content],
        ])->first();
        if ($contentExist !== null) {
            return redirect()->back()->with('contentErr', 'This content already exists.')->withInput();
        }

        $n->save();

        $notification = array(
           'message' => 'News Created Successfully', 
           'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function detailsNews($id){
        $data = News::find($id);
        return view('be.news.details',compact('data'));
    }

    public function editNews($id){
        $editData = News::find($id);
        $categories = NewsCategory::orderBy('news_category','ASC')->get(); 
        return view('be.news.edit',compact('editData','categories'));
    }

    public function UpdateNews(Request $request, $id) {
        $request->validate([
            'news_category_id' => 'required',
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string',
            'image'=>'file|image|mimes:jpeg,jpg,png,bmp,webp|max:10240',
        ], [
            'news_category_id.required' => 'News category is required.',

            'title.required' => 'News title is required.',
            'title.min' => 'News title must be at least 3 characters.',
            'title.max' => 'News title must be at most 255 characters.',

            'image.image'=>'The file uploaded must be an image file.',
            'image.mimes'=>'The images uploaded can only be a jpeg, jpg, png, bmp, or webp file.',
            'image.max'=>'News image must be maximum 10MB.',
        ]);
        
        if ($request->hasFile('image')) {
            $n = News::find($id);
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imageName = str_replace(
                pathinfo($imageName, PATHINFO_FILENAME),
                uniqid(),
                $imageName
            );

            $file->move('images/news', $imageName);

            $n->image = $imageName;
            $n->news_category_id = $request->news_category_id;

            $titleExist = News::where([
                ['id', '!=', $id],
                ['title', '=', $request->title]
            ])->first();
            if ($titleExist !== null) {
                return redirect()->back()->with('titleErr', 'This title already exists.')->withInput();
            } else {
                $n->title = $request->title;
            }
    
            $contentExist = News::where([
                ['id', '!=', $id],
                ['content', '=', $request->content]
            ])->first();
            if ($contentExist !== null) {
                return redirect()->back()->with('contentErr', 'This content already exists.')->withInput();
            } else {
                $n->content = $request->content;
            }
           
            $n->save();
            
            $notification = array(
                'message' => 'News Updated With Image Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('be.details.news', $n->id)->with($notification);

        } else {
            $n = News::find($id);
            $n->news_category_id = $request->news_category_id;

            $titleExist = News::where([
                ['id', '!=', $id],
                ['title', '=', $request->title]
            ])->first();
            if ($titleExist !== null) {
                return redirect()->back()->with('titleErr', 'This title already exists.')->withInput();
            } else {
                $n->title = $request->title;
            }
    
            $contentExist = News::where([
                ['id', '!=', $id],
                ['content', '=', $request->content]
            ])->first();
            if ($contentExist !== null) {
                return redirect()->back()->with('contentErr', 'This content already exists.')->withInput();
            } else {
                $n->content = $request->content;
            }
        
            $n->save();

            $notification = array(
                'message' => 'News Updated Without Image Successfully', 
                'alert-type' => 'success'
            );
            return redirect()->route('be.details.news', $n->id)->with($notification);
        }   
    }

    public function deleteNews($id){
        $news = News::find($id);
        $img = $news->image;
        unlink(public_path("images/news/".$img));

        News::find($id)->delete();

        $notification = array(
            'message' => 'News Deleted Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);       
    }

    // FE
    public function news()
    {
        $categories = NewsCategory::orderBy('news_category','ASC')->get();
        $recent_news = News::latest()->limit(4)->get();
        $news = News::latest()->paginate(4);
        return view('fe.news.all_news', compact('news','recent_news','categories'));
    }

    public function categoryNews($id)
    {
        $newsPost = News::where('news_category_id',$id)->orderBy('created_at','DESC')->paginate(4);
        $recent_news = News::latest()->limit(4)->get();
        $categories = NewsCategory::orderBy('news_category','ASC')->get();
        $categoryName = NewsCategory::find($id);
        return view('fe.news.category_news',compact('newsPost','recent_news','categories','categoryName'));
    }

    public function detailsNewsPage($id)
    {
        $recent_news = News::latest()->limit(4)->get();
        $news = News::findOrFail($id);
        $categories = NewsCategory::orderBy('news_category','ASC')->get();
        return view('fe.news.details',compact('news','recent_news','categories'));
    }
}
