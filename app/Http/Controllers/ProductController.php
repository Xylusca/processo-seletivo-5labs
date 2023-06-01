<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function show($id)
    {
        // Obter o produto com base no ID fornecido
        $product = Product::findOrFail($id);

        // Calcular o valor total com desconto
        $discount = $product->price * ($product->discount_percentage / 100);

        $total = number_format($product->price - $discount, 2, ',', '');

        // Passar o valor total para a view
        return view('page.product', compact('product', 'total'));
    }

    public function importProducts()
    {
        // Desativar a verificação do certificado SSL
        $response = Http::withOptions(['verify' => false])->get('https://dummyjson.com/products');

        // Obtenha os dados da API com SSL
        // $response = Http::get('https://dummyjson.com/products');

        // Verifique se a resposta foi bem-sucedida
        if ($response->ok()) {
            $data = $response->json();

            // Verifique se o vendedor já existe com base no e-mail
            $seller = User::firstOrCreate(
                ['email' => 'vendedor@example.com'],
                [
                    'name' => 'Vendedor API',
                    'password' => bcrypt('12345678'),
                    'cpf' => '000.000.000-00',
                    'birthdate' => '2000-12-25',
                    'state' => 'teste',
                    'city' => 'teste',
                    'nivel_id' => 2
                ]
            );

            // Salve os produtos no banco de dados
            foreach ($data['products'] as $item) {
                // Obtenha as URLs de imagem da lista
                $images = $item['images'];

                // Crie um array com as URLs de imagem e atribua aos campos correspondentes
                $productData = [
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'description' => $item['description'],
                    'category' => $item['category'],
                    'brand' => $item['brand'],
                    'discount_percentage' => $item['discountPercentage'],
                    'rating' => $item['rating'],
                    'stock' => $item['stock'],
                    'thumbnail' => $item['thumbnail'],
                    'image1' => isset($images[0]) ? $images[0] : null,
                    'image2' => isset($images[1]) ? $images[1] : null,
                    'image3' => isset($images[2]) ? $images[2] : null,
                    'vendor_id' => $seller->id,
                ];

                Product::create($productData);
            }

            return 'Produtos importados com sucesso!';
        }


        return 'Falha ao importar produtos.';
    }
}
