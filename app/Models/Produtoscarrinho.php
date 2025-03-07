<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produtoscarrinho extends Model
{
    protected $fillable = [
        'id',
        'produto_id',
        'carrinho_id',
        'quantidade_produto',
    ];
}
