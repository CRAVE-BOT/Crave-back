<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class calroiesrequest extends FormRequest
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
            'gender'=>'required|in:male,female',
            'age'=>'required|integer|min:15|max:100',
            'weight'=>'required|integer|min:1',
            'tall'=>'required|integer|min:1',
            'goal'=>'required|string|in:Loss weight,Maintain weight,Gain weight',
            'activity'=>'required|string',
        ];
    }
}
