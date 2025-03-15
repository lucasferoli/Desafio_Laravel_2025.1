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
        $produto_id = Arr::flatten(json_decode($request->produto_id, true));

        // Busca o ID do produto na tabela e traz os produtos para cá
        $products = Product::whereIn('id', $produto_id)->get();

        $items = $products->map(function ($product) {
            return [
                'name' => $product->name,
                'quantity' => 1,
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
            foreach ($produto_id as $id) {
                Movimentacoes::create([
                    'reference_id' => $response['reference_id'],
                    'status' => 1,
                    'product_id' => $id,
                    'buyer_id' => $request->user()->id,
                    'product_quantity' => 1, 
                    'date' => now() 
                ]);
            }

            $pay_link = data_get($response->json(), 'links.1.href');
            return redirect()->away($pay_link);
        }

        return redirect('erroDePagamento');
    }

}
