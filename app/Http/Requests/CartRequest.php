<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CartRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'product_id' => 'required|exists:products,id',
            'product_quantity' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'O campo product_id é obrigatório',
            'product_id.exists' => 'O produto não existe no banco de dados',
            'product_quantity.required' => 'O campo product_quantity é obrigatório',
            'product_quantity.integer' => 'O product_quantity precisa ser um inteiro válido',
            'product_quantity.min' => 'O product_quantity precisa ser maior que zero',
        ];
    }

    public function expectsJson()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
