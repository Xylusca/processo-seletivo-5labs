<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\User;


class ProductController extends Controller
{
    public function show($id)
    {
        // Obter o produto com base no ID fornecido
        $product = Product::findOrFail($id);

        // Incrementar o valor da coluna "visualization"
        $product->increment('visualization');

        // Calcular o valor total com desconto
        $discount = $product->price * ($product->discount_percentage / 100);
        $total = number_format($product->price - $discount, 2, ',', '');

        // Passar o valor total e o produto para a view
        return view('page.product', compact('product', 'total'));
    }
    public function purchase(Request $request)
    {
        $productId = $request->input('product_id');

        $product = Product::findOrFail($productId);
        $seller = $product->user;

        if (Auth::check()) {
            // Usuário autenticado
            $buyer = Auth::user();

            // Verificar se o vendedor é diferente do comprador
            if ($seller->id === $buyer->id) {
                return redirect()->back()->withErrors('Você não pode comprar seu próprio produto.');
            }

            // Valor do produto
            $priceWithDiscount = $product->price - ($product->price * ($product->discount_percentage / 100));

            // Verificar se o comprador tem créditos suficientes
            if ($buyer->credits < $priceWithDiscount) {
                return redirect()->back()->withErrors('Você não tem créditos suficientes para comprar este produto.');
            }

            // Realizar a transferência de créditos
            $seller->credits += $priceWithDiscount;
            $buyer->credits -= $priceWithDiscount;

            // Salvar as alterações no banco de dados
            $seller->save();
            $buyer->save();

            // Salvar a compra no banco de dados
            $purchase = new Purchase([
                'buyer_id' => $buyer->id,
                'seller_id' => $seller->id,
                'product_id' => $product->id,
                'total_price' => $priceWithDiscount,
            ]);

            $purchase->save();


            // Redirecionar com mensagem de sucesso
            return redirect()->back()->with('success', 'Compra realizada com sucesso.');
        } else {

            // Usuário não autenticado
            return redirect()->back()->withErrors('Você precisa estar logado para realizar a compra.');
        }
    }
    public function myPurchases(Request $request)
    {
        // Obter o ID do comprador autenticado
        $userId = Auth::id();

        // Obter o valor do parâmetro de pesquisa
        $searchQuery = $request->input('q');

        // Obter o valor do parâmetro de order
        $order = $request->input('order', 'rating');

        // Obter o valor do parâmetro de category
        $selectedCategory = $request->input('category');

        // Inicializar a consulta para obter as compras do comprador autenticado
        $query = Purchase::where('buyer_id', $userId)
            ->join('products', 'purchases.product_id', '=', 'products.id');

        // Verificar se há um valor de pesquisa
        if ($searchQuery) {
            $query->where('products.title', 'like', '%' . $searchQuery . '%');
        }
        // Verificar se o filtro por categoria foi aplicado
        $selectedCategory = $request->input('category');
        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        if ($order === 'rating') {
            $query->orderBy('products.rating', 'desc');
        } elseif ($order === 'price_asc') {
            $query->orderBy('purchases.total_price', 'asc');
        } elseif ($order === 'price_desc') {
            $query->orderBy('purchases.total_price', 'desc');
        }

        // Executar a consulta e obter as compras
        $purchases = $query->get();

        return view('page.my-purchase', compact('purchases', 'searchQuery', 'order', 'selectedCategory'));
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
