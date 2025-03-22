<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class productrequest extends FormRequest
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
            'name'=>'required|string|unique:products|',
            'description'=>'required|string|min:15',
            "image"=>"required|image|mimes:jpeg,png,jpg,gif,svg",
            "category_id"=>"required|string|exists:categories,id",
            'price'=>'required|numeric',
            "total_calories"=>"required|numeric",
            "protien"=>"required|numeric",
            'carb'=>"required|numeric",
            'fat' => "required|numeric",
            'weight'=>"required|numeric",
        ];
    }
}
