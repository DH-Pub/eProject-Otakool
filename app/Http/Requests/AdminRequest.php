<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:64',
            // 'email'=>'required|unique:admins',
            'email'=>'required|email:rfc,dns,filter,spoof,strict',
            'role' => 'required|string',
            'password' => ['required',
                Password::min(size:8) // at least 8 characters
                ->letters()           // at least 1 letter
                ->numbers()           // at least 1 number
            ],

            // change password page
            // 'oldpassword' => 'required',
            // 'newpassword' => 'required',
            // 'confirm_password' => 'required|same:newpassword',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Admin name is required.',
            'name.min'=>'Admin name must be at least 3 characters.',
            'name.max'=>'Admin name must be at most 64 characters.',

            // 'email.unique'=> 'An admin with this email address already exists.',
            'email.required' => 'Email address is required.',

            'role.required' => 'Role is required.',
            'password.required' => 'Password is required.',

            // change password page
            // 'oldpassword.required'=>'Old password is required.',
            // 'newpassword.required'=>'New password is required.',
            // 'confirm_password.required'=>'Confirm password is required.',
            // 'confirm_password.same'=>'Confirm password and new password must match.',
        ];
    }
}
