<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    protected $table = 'movimentacoes';

    protected $fillable = [
        'order_number',
        'product_id',
        'buyer_id',
        'product_quantity',
        'date'
    ];
}
