<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Inventoryrequest extends FormRequest
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
            'name' => 'required|string|unique:inventories,name',
            'Current_price' => 'required|numeric|min:10',
            'quantity' => 'required|integer|min:1',
            'Previous_price' => 'required|numeric|min:10',
        ];
    }
}
