<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // FE
    public function contact()
    {
        return view('fe.app.contact');
    }

    public function postContact(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:64|regex:/^[A-Za-z ]*$/',
            'email' => 'required|email:rfc,dns,filter,spoof,strict',
            'title' => 'required',
            'content' => 'required'
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be at most 64 characters.',
            'name.regex' => 'Name should be contain only letters and spaces.',

            'email.required' => 'Email address is required.',
            'email.email' => 'Email invalid.',
            'title' => 'Title is required.',
            'content' => 'Content is required.'
        ]);

        $c = new Contact($request->all());
        $c->save();

        $notification = array(
            'message' => 'Message Sent Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // BE
    public function index()
    {
        $contacts = Contact::all();
        return view('be.contact.index', compact('contacts'));
    }
}
