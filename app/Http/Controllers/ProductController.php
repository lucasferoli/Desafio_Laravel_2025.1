<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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
        $search = $request->query('search');

        $products = Product::when($search, function($query) use ($search){
                return $query->where('name', 'like', "%{$search}%");
            })->get();

    //     return response() ->json($products);
    // }

    return view('welcome', compact('products'));
}

    public function showDetails($id)
    {
        $product = Product::findOrFail($id);
        return view('product-details', compact('product'));
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

    public function update(Request $request, $product)
    {



        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::findOrFail($product);
       

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $data['photo'] = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $data['photo']);
        } else{
            $data['photo'] = $product->photo;
        }


        $data['advertiser_id'] = $product->advertiser_id;


        $product->update($data);

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
