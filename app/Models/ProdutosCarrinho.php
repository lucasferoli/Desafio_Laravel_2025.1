<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Carrinho;

class ProdutosCarrinho extends Model
{
    protected $fillable = [
        'produto_id',
        'carrinho_id',
        'quantidade_produto',
    ];

    public function cart()
    {
        return $this->belongsTo(Carrinho::class, 'carrinho_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produto_id');
    }

    protected $table = 'produtos_carrinho';
}
