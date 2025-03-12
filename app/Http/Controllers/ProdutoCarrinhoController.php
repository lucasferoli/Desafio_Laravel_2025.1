<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;
use App\Models\ProdutosCarrinho;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProdutoCarrinhoController extends Controller
{
    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'carrinho_id' => 'required|exists:carrinho,id',
            'produto_id' => 'required|exists:product,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction();

            $carrinho_id = $request->carrinho_id;
            $produto_id = $request->produto_id;
            $quantidade = $request->quantidade;

            $produtoCarrinho = ProdutosCarrinho::where('carrinho_id', $carrinho_id)
                ->where('produto_id', $produto_id)
                ->first();

            if ($produtoCarrinho) {
                $produtoCarrinho->quantidade += $quantidade;
            } else {
                $produtoCarrinho = new ProdutosCarrinho();
                $produtoCarrinho->carrinho_id = $carrinho_id;
                $produtoCarrinho->produto_id = $produto_id;
                $produtoCarrinho->quantidade = $quantidade;
            }

            $produtoCarrinho->save();

            DB::commit();

            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to add product to cart', 'details' => $e->getMessage()], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'carrinho_id' => 'required|exists:carrinhos,id',
            'produto_id' => 'required|exists:product,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction();

            $carrinho_id = $request->carrinho_id;
            $produto_id = $request->produto_id;

            $produtoCarrinho = ProdutosCarrinho::where('carrinho_id', $carrinho_id)
                ->where('produto_id', $produto_id)
                ->first();

            if (!$produtoCarrinho) {
                return response()->json(['error' => 'Product not found in the cart'], 404);
            }

            $produtoCarrinho->delete();

            DB::commit();

            return response()->json(['message' => 'Product removed from cart successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to remove product from cart', 'details' => $e->getMessage()], 500);
        }
    }
}
