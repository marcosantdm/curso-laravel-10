<?php

namespace App\Models;

    /*
    * O eloquent espera que a tabela tenha o nome no plural,
    * por isso o nome da classe é no singular e o nome da tabela é no plural.
    * Logo não é necessário informar o nome da tabela, pois o eloquent já sabe que é a tabela supports,
    * ou seja, que tem o nonme igual a model, porém no plural
    */

use App\Enums\SupportStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    /*
    * O atributo fillable é um array que contém os campos que podem ser preenchidos em massa,
    * ou seja, quando for criar um novo registro com formulario, apenans os campos que estiverem
    * no fillable poderão ser preenchidos.
    */
    protected $fillable = [
        'subject',
        'body',
        'status'
    ];

    // protected $casts = [
    //     'status' => SupportStatus::class
    // ];

    public function status(): Attribute
    {
        return Attribute::make(
            set: fn (SupportStatus $status) => $status->name,
        );
    }
}
