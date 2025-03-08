<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produtoscarrinho extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'cart_id',
        'product_quantity',
    ];
}
