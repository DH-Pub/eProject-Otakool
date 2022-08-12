<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Orderdetail;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class CustomerController extends Controller
{
    // FRONT END PAGE-----------------------------------------------------------
    public function register()
    {
        return view('fe.customer.register');
    }

    public function postRegister(CustomerRequest $request)
    {
        //dd($request->all()); //debug

        $customer = $request->all();
        $c = new Customer($customer);
        if ($request->password != $request->confirm_password) {
            return redirect()->route('customer.register')->with('passErr', 'Password and Confirm Password are not the same')->withInput();
        }

        $emailExist = Customer::where([
            ['email', '=', $request->email],
        ])->first();
        if ($emailExist !== null) {
            return redirect()->route('customer.register')->with('emailErr', 'A customer with this email address already exists.')->withInput();
        }

        $usernameExist = Customer::where([
            ['username', '=', $request->username],
        ])->first();
        if ($usernameExist !== null) {
            return redirect()->route('customer.register')->with('usernameErr', 'A customer with this username already exists.')->withInput();
        }

        // $nameExist = Customer::where([
        //     ['name', '=', $request->name],
        // ])->first();
        // if ($nameExist !== null) {
        //     return redirect()->route('customer.register')->with('nameErr', 'A customer with this name already exists.')->withInput();
        // }

        $c->password = Hash::make($request->password);
        $c->save();
        // return redirect()->route('customer.checkout');
        return redirect()->route('customer.login');
    }

    public function login()
    {
        return view('fe.customer.login');
    }

    public function loggedIn(Request $request)
    {
        $check = $request->all();
        if (Auth::guard('customer')->attempt([
            'email' => $check['email'],
            'password' => $check['password'],
        ])) {
            $notification = array(
                'message' => 'Logged In Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('index')->with($notification);
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function CustomerAccount()
    {
        $id = Auth::guard('customer')->user()->id;
        $customer = Customer::find($id);
        return view('fe.customer.account', compact('customer'));
    }

    public function CustomerEditAccount($id)
    {
        $editData = Customer::find($id);
        return view('fe.customer.edit_account', compact('editData'));
    }

    public function CustomerUpdateAccount(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:100|regex:/^[A-Za-z ]*$/',
            'username' => 'required|string|min:3|max:64|regex:/^[A-Za-z0-9_]{3,64}$/',
            'address' => 'required',
            'email' => 'required|email:rfc,dns,filter,spoof,strict',
            'tel' => ['required', 'regex:/^((03)|(05)|(07)|(08)|(09))[0-9]{8}$/'],
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be at most 100 characters.',
            'name.regex' => 'Name should be contain only letters and spaces.',

            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.max' => 'Username must be at most 64 characters.',
            'username.regex' => 'Username should be contain only letters, digits and underscore.',

            'address.required' => 'Address is required.',
            'email.required' => 'Email address is required.',

            'tel.required' => 'Phone number is required',
            'tel.regex' => 'Phone number is invalid',
        ]);

        $data = Customer::find($id);
        $data->name = $request->name;
        $data->tel = $request->tel;
        $data->address = $request->address;

        // $nameExist = Customer::where([
        //     ['id', '!=', $id],
        //     ['name', '=', $request->name],
        // ])->first();

        $usernameExist = Customer::where([
            ['id', '!=', $id],
            ['username', '=', $request->username],
        ])->first();

        $emailExist = Customer::where([
            ['id', '!=', $id],
            ['email', '=', $request->email],
        ])->first();

        // if ($nameExist !== null) {
        //     return redirect()->back()->with('nameErr', 'A user with this name already exists.')->withInput();
        if ($usernameExist !== null) {
            return redirect()->back()->with('usernameErr', 'A user with this username already exists.')->withInput();
        } elseif ($emailExist !== null) {
            return redirect()->back()->with('emailErr', 'A user with this email already exists.')->withInput();
        } else {
            $data->username = $request->username;
            $data->email = $request->email;
            $data->save();

            $notification = array(
                'message' => 'Updated Account Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.account', $id)->with($notification);
        }
    }

    public function CustomerChangePassword()
    {
        return view('fe.customer.change_password');
    }

    public function CustomerUpdatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => [
                'required',
                Password::min(size: 8) // at least 8 characters
                    ->letters()           // at least 1 letter
                    ->numbers()           // at least 1 number
            ],
            'confirm_password' => 'required|same:newpassword',
        ], [
            'oldpassword.required' => 'Current password is required.',
            'newpassword.required' => 'New password is required.',
            'confirm_password.required' => 'Retype new password is required.',
            'confirm_password.same' => 'Retype new password and new password must match.',
        ]);

        $hashedPassword = Auth::guard('customer')->user()->password;
        // check matches
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            // find authenticate admin id
            $customers = Customer::find(Auth::guard('customer')->id());
            // hash new password
            $customers->password = bcrypt($request->newpassword);
            $customers->save();

            $notification = array(
                'message' => 'Password Updated Successfully. Please Login Again!',
                'alert-type' => 'success'
            );
            Auth::guard('customer')->logout();
            
            return redirect()->route('customer.login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Old password is not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function CustomerLogout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('customer.login')->with($notification);
    }

    public function MyOrders()
    {
        $customer = Auth::guard('customer')->user();
        $orders = Order::where([
            ['cust_id', $customer->id],
            ['status', '!=', 'cart'],
        ])->with('orderdetails')->orderBy('created_at', 'desc')->paginate(10);
        return view('fe.customer.view_my_orders', compact('orders'));
    }


    // ADMIN PAGE-----------------------------------------------------------
    // main admin only ------
    public function index()
    {
        if (Auth::guard('admin')->user()->role == 'main') {
            $customers = Customer::all();
            return view('be.customer.index', compact('customers'));
        }
    }

    public function delete($id)
    {
        if (Auth::guard('admin')->user()->role == 'main') {
            $c = Customer::find($id);
            $c->delete('');
            return redirect()->route('customer.index');
        }
    }
    // ------------------------

    public function profile($id)
    {
        // $id = Auth::guard('admin')->user()->id;
        $customerData = Customer::find($id);
        return view('be.customer.view_profile', compact('customerData'));
    }

    public function editProfile($id)
    {
        // $id = Auth::guard('admin')->user()->id;
        $editData = Customer::find($id);
        return view('be.customer.edit_profile', compact('editData'));
    }

    public function updateProfile(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:100|regex:/^[A-Za-z ]*$/',
            'username' => 'required|string|min:3|max:64|regex:/^[A-Za-z0-9_]{3,64}$/',
            //'address'=>'required',
            'email' => 'required|email:rfc,dns,filter,spoof,strict',
            'tel' => ['required', 'regex:/^((03)|(05)|(07)|(08)|(09))[0-9]{8}$/'],
        ], [
            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be at most 100 characters.',
            'name.regex' => 'Name should be contain only letters and spaces.',

            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.max' => 'Username must be at most 64 characters.',
            'username.regex' => 'Username should be contain only letters, digits and underscore.',

            //'address.required' => 'Address is required.',
            'email.required' => 'Email address is required.',

            'tel.required' => 'Phone number is required',
            'tel.regex' => 'Phone number is invalid',
        ]);

        $data = Customer::find($id);
        $data->name = $request->name;
        $data->status = $request->status;
        $data->tel = $request->tel;
        $data->address = $request->address;

        // $nameExist = Customer::where([
        //     ['id', '!=', $id],
        //     ['name', '=', $request->name],
        // ])->first();

        $usernameExist = Customer::where([
            ['id', '!=', $id],
            ['username', '=', $request->username],
        ])->first();

        $emailExist = Customer::where([
            ['id', '!=', $id],
            ['email', '=', $request->email],
        ])->first();

        // if ($nameExist !== null) {
        //     return redirect()->back()->with('nameErr', 'A customer with this name already exists.')->withInput();
        if ($usernameExist !== null) {
            return redirect()->back()->with('usernameErr', 'A customer with this username already exists.')->withInput();
        } elseif ($emailExist !== null) {
            return redirect()->back()->with('emailErr', 'A customer with this email already exists.')->withInput();
        } else {
            $data->username = $request->username;
            $data->email = $request->email;
            $data->save();

            $notification = array(
                'message' => 'Customer Profile Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('customer.profile', $id)->with($notification);
        }
    }
}
