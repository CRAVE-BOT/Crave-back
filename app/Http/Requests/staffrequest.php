<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class staffrequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staffs,email',
            'salary' => 'required|numeric|min:0',
            'phone' => 'required|string|min:10|',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|string',
        ];
    }
}
