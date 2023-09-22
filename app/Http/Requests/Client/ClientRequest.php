<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'cpf' => 'required|string|max:11',
            'birthdate' => 'required|date',
            'email' => 'required|email',
            'zip_code' => 'required|string|max:8',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.max' => 'O campo nome não pode ter mais de :max caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.string' => 'O campo CPF deve ser uma string.',
            'cpf.max' => 'O campo CPF não pode ter mais de :max caracteres.',
            'birthdate.required' => 'O campo dtNascimento é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'zip_code.required' => 'O campo Cep é obrigatório.',
            'street.required' => 'O nome da rua é obrigatório.',
            'house_number.required' => 'O número é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'state.required' => 'O UF é obrigatório.',
            'state.max' => 'O campo nome não pode ter mais de :max caracteres.',
            
        ];
    }
}