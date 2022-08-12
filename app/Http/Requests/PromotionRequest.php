<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionRequest extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'start' => 'required',
            'end' => 'required|after:start',
            'applied_products' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'type.required' => 'Type is required',
            'amount.required' => 'Amount is required',
            'start.required' => 'Start Date is required',
            'end.required' => 'End Date is required',
            'end.after' => 'End Date should be after Start Date',
            'applied_products.required' => 'Applied Products is required',
        ];
    }
}
