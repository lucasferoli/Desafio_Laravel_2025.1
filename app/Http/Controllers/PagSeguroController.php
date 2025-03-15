<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PagSeguroController extends Controller
{
    public function createCheckout(Request $request)
    {
        $url = config('services.pagseguro.checkout_url');
        $token = config('services.pagseguro.token');

        $produto_id = json_decode($request->produto_id, true);
        $items = array_map(fn($product) => [
            'name' => $product['name'],
            'quantity' => $product['quantity'],
            'unit_amount' => $product['price'] * 100
        ], $produto_id);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-type' => 'application/json'
        ])->withoutVerifying()->post($url, [
            'reference_id' => uniqid(),
            'items' => $items
        ]);

        if ($response->successful()) {
            // Handle successful response
        }
    }
}
