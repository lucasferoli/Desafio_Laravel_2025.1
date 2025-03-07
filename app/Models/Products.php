<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'id', 'foto', 'nome', 'preco', 'quantidade', 'descricao', 'categoria', 'anunciante_id'
    ];
}
