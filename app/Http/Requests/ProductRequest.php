<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required',
            'type' => 'required',
            'cover' => 'file|image|mimes:jpeg,jpg,png,bmp,webp|max:10240',
            'images.*' => 'file|image|mimes:jpeg,jpg,png,bmp,webp|max:10240',
            'folder' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name' => [
                'required' => 'Product name is required.',
                'min' => 'Product name must be at least 3 characters.',
                'max' => 'Product name must be at most 255 characters.',
            ],
            'price' => [
                'required' => 'Product price is required.',
                'numeric' => 'Product price must be a number.',
            ],
            'quantity' => [
                'required' => 'Product quantity is required.',
                'integer' => 'Product quantity must be an integer.',
            ],
            'status.required' => 'Product status is required.',
            'type.required' => 'Product type must be required.',
            'cover' => [
                'image' => 'The file uploaded must be an image file.',
                'mimes' => 'The image uploaded can only be a jpeg, jpg, png, bmp, or webp file.',
                'max' => 'Product image must be maximum 10MB.',
            ],
            'images.*' => [
                'image' => 'The file uploaded must be an image file.',
                'mimes' => 'The images uploaded can only be a jpeg, jpg, png, bmp, or webp file.',
                'max' => 'Product image must be maximum 10MB.',
            ],
            'folder.required' => 'Product folder is required.',
        ];
    }
}
