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
        // Validate the request
        $validator = Validator::make($request->all(), [
            'carrinho_id' => 'required|exists:carrinhos,id',
            'produto_id' => 'required|exists:product,id', // Fix: Correct table name
            'quantidade' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction(); // Start transaction

            $carrinho_id = $request->carrinho_id;
            $produto_id = $request->produto_id;
            $quantidade = $request->quantidade;

            // Find existing cart item
            $produtoCarrinho = ProdutosCarrinho::where('carrinho_id', $carrinho_id)
                ->where('produto_id', $produto_id)
                ->first();

            if ($produtoCarrinho) {
                // Update quantity
                $produtoCarrinho->quantidade += $quantidade;
            } else {
                // Create new cart item
                $produtoCarrinho = new ProdutosCarrinho();
                $produtoCarrinho->carrinho_id = $carrinho_id;
                $produtoCarrinho->produto_id = $produto_id;
                $produtoCarrinho->quantidade = $quantidade;
            }

            $produtoCarrinho->save();

            DB::commit(); // Commit transaction

            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            return response()->json(['error' => 'Failed to add product to cart', 'details' => $e->getMessage()], 500);
        }
    }

    public function removeFromCart(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'carrinho_id' => 'required|exists:carrinhos,id',
            'produto_id' => 'required|exists:product,id', // Fix: Correct table name
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            DB::beginTransaction(); // Start transaction

            $carrinho_id = $request->carrinho_id;
            $produto_id = $request->produto_id;

            // Find cart item
            $produtoCarrinho = ProdutosCarrinho::where('carrinho_id', $carrinho_id)
                ->where('produto_id', $produto_id)
                ->first();

            if (!$produtoCarrinho) {
                return response()->json(['error' => 'Product not found in the cart'], 404);
            }

            // Remove item from cart
            $produtoCarrinho->delete();

            DB::commit(); // Commit transaction

            return response()->json(['message' => 'Product removed from cart successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            return response()->json(['error' => 'Failed to remove product from cart', 'details' => $e->getMessage()], 500);
        }
    }
}
