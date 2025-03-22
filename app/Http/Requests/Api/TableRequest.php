<?php

namespace App\Http\Requests\Api;

use App\helper\Apihelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class TableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response =Apihelper::sendrespone('422','Erorr Validation',$validator->errors());
            throw new ValidationException($validator, $response);
        }
    }
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
            'number'=>'required|integer|exists:tables,number',
            'date'=>'required|date',
            'time'=>'required',
            'number_people'=>'required|integer',
        ];
    }
}
