<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

         $rules =  [
            'subject' => 'required|min:3|max:255|unique:supports',
            'body' => [
                'required',
                'min:3',
                'max:10000'
            ]
        ];

        /**
         * Caso as regras de Update e Create estivessem em arquivos diferentes esse if() não seria necessário
         * A prática de centralizar as regras em um único arquivo é uma boa prática, pois facilita a reutilização de código
         * quando se tem diversos campos iguais em diferentes formulários
         */

         /**
         ** O unique funciona da seguinte maneira:
         ** unique:nome_da_tabela,coluna_do_banco_de_dados,variavel_ou_dado_a_ser_enviado,coluna_do_banco_de_dados
         ** Após serem enviados o nome da tabela e a coluna, os dados a seguir são opcionais e se tornam uma excessão a regra
         ** por exemplo: unique:supports,subject,{$this->id}, significa que só será único se o ID na variável $this->id
         ** for diferente da coluna id, do contrário poderá ser repetido. Exemplo: Estou editando o registro de ID 1,
         ** nome: teste, conteudo: teste, se eu alterar apenas o conteudo e mantiver o nome como teste, o sistema irá verificar
         ** as regras, se esse nome já existir o sistema retornará um erro, porém se o id desse registro(1) for igual ao id
         ** que está sendo editado no banco de dados, o sistema irá ignorar a regra de unique e permitir a edição.
         */

        if ($this->method() === 'PUT') {
            $rules['subject'] = [
                'required',
                'min:3',
                'max:255',
                // "unique:supports,subject,{$this->id},id"

                 /**
                  * A classe Rule funciona da mesma maneira que o unique, porém é mais legível e mais fácil de utilizar
                  * O subject só será único se o ID na variável $this->id for diferente da coluna id, do contrário poderá ser repetido.
                  */
                Rule::unique('supports')->ignore($this->id),
            ];
        }

        return $rules;
    }
}
