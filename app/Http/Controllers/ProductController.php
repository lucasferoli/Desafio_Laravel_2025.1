<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\Cast\String_;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('editarProdutos', compact('products'));
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

        $data = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $data['photo'] = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $data['photo']);
        }

        $data['advertiser_id'] = Auth::user()->id;

        Product::create($data);

        return redirect()->route('paginaDoPerfil')->with('success', 'Produto criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'advertiser_id' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $product->photo = $imageName;
        }

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->advertiser_id = $request->input('advertiser_id');
        $product->save();

        return redirect()->route('editarProdutos')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Storage::delete('public/products/' . $product->photo);
        $product->delete();

        return redirect()->route('editarProdutos')->with('success', 'Produto deletado com sucesso!');
    }
}
