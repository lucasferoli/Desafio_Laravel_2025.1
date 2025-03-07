<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    protected $table = 'movimentacoes';

    protected $fillable = [
        'numero_pedido',
        'produto_id',
        'comprador_id',
        'quantidade_produto',
        'data'
    ];
}
