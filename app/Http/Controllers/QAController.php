<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QA;

class QAController extends Controller
{
    // FE
    public function qa()
    {
        $qas = QA::latest()->get();;
        return view('fe.app.q&a', compact('qas'));
    }

    //BE
    public function createQA()
    {
        return view('be.qa.create');
    }

    public function postQA(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|min:3|max:64',
            'content' => 'required|string'
        ], [
            'title.required' => 'Name is required.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.max' => 'Title must be at most 64 characters.',

            'content.required' => 'Content is required.'
        ]);

        $q = new QA($request->all());

        $titleExist = QA::where([
            ['title', '=', $request->title],
        ])->first();
        if ($titleExist !== null) {
            return redirect()->back()->with('titleErr', 'This title already exists.')->withInput();
        }

        $contentExist = QA::where([
            ['content', '=', $request->content],
        ])->first();
        if ($contentExist !== null) {
            return redirect()->back()->with('contentErr', 'This content already exists.')->withInput();
        }

        $q->save();

        $notification = array(
            'message' => 'Q&A Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function index()
    {
        $qas = QA::all();
        return view('be.qa.index', compact('qas'));
    }

    public function detailsQA($id)
    {
        $data = QA::find($id);
        return view('be.qa.details', compact('data'));
    }

    public function editQA($id)
    {
        $editData = QA::find($id);
        return view('be.qa.edit', compact('editData'));
    }

    public function updateQA(Request $request, $id)
    {
        $validateData = $request->validate([
            'title' => 'required|string|min:3|max:64',
            'content' => 'required|string'
        ], [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.max' => 'Title must be at most 64 characters.',

            'content.required' => 'Content is required.'
        ]);

            $data = QA::find($id);

            $titleExist = QA::where([
                ['id', '!=', $id],
                ['title', '=', $request->title]
            ])->first();
            if ($titleExist !== null) {
                return redirect()->back()->with('titleErr', 'This title with content already exists.')->withInput();
            } else {
                $data->title = $request->title;
            }
    
            $contentExist = QA::where([
                ['id', '!=', $id],
                ['content', '=', $request->content],
            ])->first();
            if ($contentExist !== null) {
                return redirect()->back()->with('contentErr', 'This content already exists.')->withInput();
            } else {
                $data->content = $request->content;
            }

            $data->save();

            $notification = array(
                'message' => 'Q&A Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('be.details.qa', $id)->with($notification);
    }

    public function delete($id)
    {
        $q = QA::find($id);
        $q->delete('');
        return back();
    }
}
