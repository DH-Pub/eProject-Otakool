<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:100|regex:/^[A-Za-z ]*$/',
            'username'=>'required|string|min:3|max:64|regex:/^[A-Za-z0-9_]{3,64}$/',
            'email'=>'required|email:rfc,dns,filter,spoof,strict',
            'tel' => ['required','regex:/^((03)|(05)|(07)|(08)|(09))[0-9]{8}$/'],
            'address'=>'required',
            'password' => ['required',
                Password::min(size:8) // at least 8 characters
                ->letters()           // at least 1 letter
                ->numbers()           // at least 1 number
            ],
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Name is required.',
            'name.min'=>'Name must be at least 3 characters.',
            'name.max'=>'Name must be at most 100 characters.',
            'name.regex'=>'Name should be contain only letters and spaces.',

            'username.required'=>'Username is required.',
            'username.min'=>'Username must be at least 3 characters.',
            'username.max'=>'Username must be at most 64 characters.',
            'username.regex'=>'Username should be contain only letters, digits and underscore.',

            'email.required' => 'Email address is required.',

            'tel.required'=>'Phone number is required',
            'tel.regex'=>'Phone number is invalid',

            'address.required'=>'Address is required',

            'password.required'=>'Password is required.',

            'confirm_password.required'=>'Confirm password is required.',
            'confirm_password.same'=>'Confirm password and password must match',
        ];
    }
}
