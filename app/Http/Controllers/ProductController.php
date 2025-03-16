<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admProdutos', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%")
                            ->get();
        return view('welcome', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'descricao' => 'required|string',
            'categoria' => 'required|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
        }

        $product = new Product();
        $product->foto = $imageName;
        $product->nome = $request->input('nome');
        $product->preco = $request->input('preco');
        $product->quantidade = $request->input('quantidade');
        $product->descricao = $request->input('descricao');
        $product->categoria = $request->input('categoria');
        $product->save();

        return redirect()->route('admProdutos')->with('success', 'Produto criado com sucesso!');
    }
}
