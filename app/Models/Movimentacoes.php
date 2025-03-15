<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    protected $table = 'movimentacoes';

    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

    protected $fillable = [
        'product_id',
        'buyer_id',
        'product_quantity',
        'date'
    ];
}
