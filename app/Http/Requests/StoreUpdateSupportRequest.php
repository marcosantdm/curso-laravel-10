<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSupportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        /**
         *? Regras utilizadas para as validações de criação e edição de registros com os respectivos campos do formulário
         *? subject: campo obrigatório, mínimo de 3 caracteres, máximo de 255 caracteres, único na tabela supports
         *? No caso dessa aplicação, os campos para validar ficarão no mesmo arquivo, porém é uma boa prática separa-los
         *? em arquivos diferentes para que não haja confusão.
         ** A separação das regras pode ser feita de mais de 1 maneira, tanto com PIPE (|) quanto com ARRAY (,)
         ** No caso de separação com array o código fica mais legível, facilitanto futuras manutenções
         */
        return [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:10000'
            ]
        ];
    }
}
