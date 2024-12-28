<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class InvestmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name'=>'required|string',
            // 'phone'=>'required|numeric',
            // 'email'=>'required|email',
            // 'password'=>'required|min:6|confirmed',
            // 'address'=>'required|string',
            // 'city'=>'required|string',
            // 'district'=>'required|string',
            // 'zipCode'=>'required|numeric',
            // 'image'=>'required',

            'investor_id'=>'required',
            'project_id'=>'required',
            'total_Investment'=>'required',
            'installment_type'=>'required',
            'profit_type'=>'required',
            'profit'=>'required',
            'installment_amount'=>'required',
        ];
    }
}
