<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Method to display the list of products
    public function index()
    {
        $products = Product::all();
        return view('admProdutos', compact('products'));
    }

    // Method to handle product creation
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'required|string',
            'categoria' => 'required|string|max:255',
        ]);

        // Handle the file upload
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName); // Save the file in the storage
        }

        // Create a new product
        $product = new Product();
        $product->foto = $imageName;
        $product->nome = $request->input('nome');
        $product->preco = $request->input('preco');
        $product->quantidade = $request->input('quantidade');
        $product->descricao = $request->input('descricao');
        $product->categoria = $request->input('categoria');
        $product->save();

        // Redirect back with a success message
        return redirect()->route('admProdutos')->with('success', 'Produto criado com sucesso!');
    }
}