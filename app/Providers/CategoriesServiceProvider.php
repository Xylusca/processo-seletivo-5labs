<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class CategoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Obtenha todas as categorias distintas da coluna "category" na tabela de produtos
        $categories = Product::distinct()->pluck('category');

        // Compartilhe as categorias em todas as views
        View::composer('*', function ($view) use ($categories) {
            $view->with('categories', $categories);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
