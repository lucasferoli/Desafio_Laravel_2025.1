<?php

namespace App\Http\Controllers;

use App\Models\Product;


abstract class Controller
{
    //
}

class ProductController extends Controller
{
    public function showRandomProduct()
    {

        $randomProduct = Product::inRandomOrder()->first();

        return view('modal-produto', compact('randomProduct'));
    }
}