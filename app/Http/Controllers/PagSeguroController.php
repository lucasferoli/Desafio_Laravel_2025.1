<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movimentacoes;
use App\Models\Product;
use Illuminate\Support\Arr;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');

        // Utilizamos o flatten para converter o Array Json em um array normal, que irá mandar as informações para o PagSeguro
        $produto_id = Arr::flatten((array) json_decode($request->input('produto_id'), true));

        // Busca o ID do produto na tabela e traz os produtos para cá
        $products = Product::whereIn('id', $produto_id)->get();

        $quantidadeProduto = request('quantidade_produto', 1);

        $items = $products->map(function ($product) use ($quantidadeProduto) {
            return [
                'name' => $product->name,
                'quantity' => $quantidadeProduto,
                'unit_amount' => $product->price * 100,
            ];
        })->toArray();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-type' => 'application/json'
        ])->withoutVerifying()->post($url, [
            'reference_id' => uniqid(),
            'items' => $items
        ]);

        if ($response->successful()) {

            //Atualiza quantidade do produto na tabela
            foreach ($products as $product) {
                if ($product->quantity >= $quantidadeProduto) {
                    $product->quantity -= $quantidadeProduto;
                    $product->save();
                } else {
                    return redirect()->route('erroDePagamento')->withErrors([
                        'quantidade_produto' => 'Quantidade solicitada não disponível para o produto: ' . $product->name
                    ]);
                }

                //Atualiza saldo de quem vendeu o produto
                $valorTotal = $product->price * $quantidadeProduto;
                $anunciante = $product->advertiser;
                $anunciante->balance += $valorTotal;
                $anunciante->save();

                Movimentacoes::create([
                    'reference_id' => $response['reference_id'],
                    'status' => 1,
                    'product_id' => $product->id,
                    'buyer_id' => $request->user()->id,
                    'product_quantity' => $quantidadeProduto,
                    'date' => now()
                ]);
            }
            $pay_link = data_get($response->json(), 'links.1.href');
            return redirect()->away($pay_link);
        }

        return redirect('erroDePagamento');
    }
}
