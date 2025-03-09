<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'address' => ['nullable', 'string', 'max:255'], // Address field
            'telephone' => ['nullable', 'string', 'max:15'], // Telephone field
            'birth_date' => ['nullable', 'date'], // Birth date field
            'cpf' => [
                'nullable',
                'string',
                'max:14',
                Rule::unique(User::class)->ignore($this->user()->id), // Ensure CPF is unique
            ],
            'photo' => ['nullable', 'string', 'url'], // Photo field (URL)
            'balance' => ['nullable', 'numeric', 'min:0'], // Balance field
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.unique' => 'Este email já está em uso.',
            'address.max' => 'O endereço deve ter no máximo 255 caracteres.',
            'telephone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'birth_date.date' => 'A data de nascimento deve ser uma data válida.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.max' => 'O CPF deve ter no máximo 14 caracteres.',
            'photo.url' => 'A foto deve ser uma URL válida.',
            'balance.numeric' => 'O saldo deve ser um número.',
            'balance.min' => 'O saldo não pode ser negativo.',
        ];
    }
}