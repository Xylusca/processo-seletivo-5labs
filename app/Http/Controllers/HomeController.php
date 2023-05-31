<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // número de itens por página
        $perPage = 9;

        // Obter os produtos paginados
        $products = Product::with('user')->paginate($perPage);

        return view('page.home', compact('products'));
    }
}
