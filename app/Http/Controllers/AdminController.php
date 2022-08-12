<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    // main admin only ------
    public function index()
    {
        if (Auth::guard('admin')->user()->role == 'main') {
            $admins = Admin::all();
            return view('be.admin.index', compact('admins'));
        }
    }
    public function register()
    {
        if (Auth::guard('admin')->user()->role == 'main') {
            return view('be.admin.register');
        }
    }
    public function delete($id)
    {
        if (Auth::guard('admin')->user()->role == 'main') {
            $a = Admin::find($id);
            $a->delete('');
            return redirect()->route('admin.index');
        }
    }
    // ------------------------

    public function postRegister(AdminRequest $request)
    {
        $admin = $request->all();
        $a = new Admin($admin);
        if ($request->password != $request->confirm_pass) {
            return redirect()->route('admin.register')->with('passErr', 'Password and Confirm Password are not the same')->withInput();
        }
        $emailExist = Admin::where([
            ['email', '=', $request->email],
        ])->first();
        if ($emailExist !== null) {
            return redirect()->route('admin.register')->with('emailErr', 'An admin with this email address already exists.')->withInput();
        }
        $a->password = Hash::make($request->password);
        $a->save();
        return redirect()->route('admin.index');
    }

    public function login()
    {
        return view('be.admin.login');
    }

    public function loggedIn(Request $request)
    {
        // dd($request->all());//debug

        $check = $request->all();
        if (Auth::guard('admin')->attempt([
            'email' => $check['email'],
            'password' => $check['password'],
        ])) {
            return redirect()->route('be')->with('success', 'Admin logged in successfully');
        } else {
            return back()->with('error', 'Invalid email or password');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function profile($id)
    {
        // $id = Auth::guard('admin')->user()->id;
        if($this->checkAdmin($id)){
            $adminData = Admin::find($id);
            return view('be.admin.view_profile', compact('adminData'));
        } else {
            return view('be.admin.unauthorized');
        }
    }
    public function editProfile($id)
    {
        // $id = Auth::guard('admin')->user()->id;
        if($this->checkAdmin($id)){
            $editData = Admin::find($id);
            return view('be.admin.edit_profile', compact('editData'));
        } else {
            return view('be.admin.unauthorized');
        }
    }
    public function updateProfile(Request $request, $id)
    {
        if(!$this->checkAdmin($id)){
            return view('be.admin.unauthorized');
        }

        $validateData = $request->validate([
            'name' => 'required|string|min:3|max:64',
            'email'=>'required|email:rfc,dns,filter,spoof,strict',
            'role' => 'required|string',
        ],[
            'name.required'=>'Admin name is required.',
            'name.min'=>'Admin name must be at least 3 characters.',
            'name.max'=>'Admin name must be at most 64 characters.',

            'email.required' => 'Email address is required.',

            'role.required' => 'Role is required.',
        ]);

        $data = Admin::find($id);
        $data->name = $request->name;
        $data->role = $request->role;
        $data->details = $request->details;

        $emailExist = Admin::where([
            ['id', '!=', $id],
            ['email', '=', $request->email],
        ])->first();
        if ($emailExist !== null) {
            return redirect()->back()->with('emailErr', 'An admin with this email address already exists.')->withInput();
        } else {
            $data->email = $request->email;
            $data->save();

            $notification = array(
                'message' => 'Admin Profile Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.profile', $id)->with($notification);
        }
    }

    public function changePassword()
    {
        return view('be.admin.change_password');
    }

    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => ['required',
                Password::min(size:8) // at least 8 characters
                ->letters()           // at least 1 letter
                ->numbers()           // at least 1 number
            ],
            'confirm_password' => 'required|same:newpassword',
        ],[
            'oldpassword.required'=>'Current password is required.',
            'newpassword.required'=>'New password is required.',
            'confirm_password.required'=>'Retype new password is required.',
            'confirm_password.same'=>'Retype new password and new password must match.',
        ]);

        $hashedPassword = Auth::guard('admin')->user()->password;
        // check matches
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            // find authenticate admin id
            $admins = Admin::find(Auth::guard('admin')->id());
            // hash new password
            $admins->password = bcrypt($request->newpassword);
            $admins->save();

            $notification = array(
                'message' => 'Admin Password Updated Successfully. Please Login Again!',
                'alert-type' => 'success'
            );
            Auth::guard('admin')->logout();

            return redirect()->route('admin.login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Old password is not match',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function checkAdmin($id)
    {
        if (Auth::guard('admin')->user()->id == $id || Auth::guard('admin')->user()->role == 'main') {
            return true;
        } else {
            return false;
        }
    }
}
