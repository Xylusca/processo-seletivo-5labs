<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 9;
        $query = Product::query();

        // Verificar se a ordenação foi definida
        $order = $request->input('order', 'rating');

        if ($order === 'rating') {
            $query->orderBy('rating', 'desc');
        } elseif ($order === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($order === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        // Verificar se a busca por título foi realizada
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $query->where('title', 'LIKE', "%{$searchQuery}%");
        }

        // Verificar se o filtro por categoria foi aplicado
        $selectedCategory = $request->input('category');
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        // Recuperar a lista de categorias
        $categories = $query->distinct()->pluck('category');

        // Obter os produtos paginados
        $products = $query->with('user')->paginate($perPage);

        return view('page.home', compact('products', 'order', 'searchQuery', 'selectedCategory', 'categories'));
    }
}
