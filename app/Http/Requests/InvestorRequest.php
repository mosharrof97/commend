<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Investor;


class InvestorRequest extends FormRequest
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
            //  'image'=>['required', 'image','mimes:jpg,png,jpeg,gif,svg', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000','max:2048'] ,
            'name' => 'required|string',
            'father_name' => 'required|string',
            'mother_name' => 'required|string',
            'phone' => ['required', 'numeric', 'unique:'.Investor::class],
            'email' => ['required', 'email', 'unique:'.Investor::class],
            'nid' => 'required|numeric',
            'tin' => 'required|numeric',
            'password' => 'required|min:6|confirmed',
            'pre_address' => 'required|string',
            'pre_city' => 'required|string',
            'pre_district' => 'required|string',
            'pre_zipCode' => 'required|numeric',
            'per_address' => 'required|string',
            'per_city' => 'required|string',
            'per_district' => 'required|string',
            'per_zipCode' => 'required|numeric',
            'image' => ['required', 'image'],
        ];
    }
}
