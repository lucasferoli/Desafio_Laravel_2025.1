<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'id',
        'nome',
        'email',
        'senha',
        'endereco',
        'telefone',
        'data_nascimento',
        'cpf',
        'foto', // opcional
    ];
}
