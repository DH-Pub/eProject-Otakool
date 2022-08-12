<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // FE
    public function postFeedback(Request $request)
    {
        if (Auth::guard('customer')->check()) {
            $id = Auth::guard('customer')->user()->id;
            $feedback = $request->all();
            $f = new Feedback($feedback);
            $f->cust_id = $id;
            $f->save();

            $notification = array(
                'message' => 'Thank you for your feedback!',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Please Login First',
                'alert-type' => 'error'
            );
        return redirect()->back()->with($notification);
        } 
    }

    // BE
    public function feedback()
    {
        $feedbacks = Feedback::with('customers')->get();
        return view('be.feedback.index', compact('feedbacks'));
    }

    public function ApprovalFeedback($id)
    {
        $feedback = Feedback::find($id);
        $feedback->status = '1';
        $feedback->save();
       
        return redirect()->back(); 
    }
}
