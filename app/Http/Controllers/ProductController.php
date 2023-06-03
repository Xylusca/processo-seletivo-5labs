<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
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

            $seller = User::where('email', 'vendedor@example.com')
                ->orWhere('cpf', '000.000.000-00')
                ->first();

            if ($seller) {
                // O vendedor já existe, retorne uma mensagem informando
                return 'O e-mail ou CPF já estão sendo usados.';
            } else {
                // O vendedor não existe, crie um novo registro
                $seller = User::create([
                    'name' => 'Vendedor API',
                    'email' => 'vendedor@example.com',
                    'password' => bcrypt('12345678'),
                    'cpf' => '000.000.000-00',
                    'birthdate' => '2000-12-25',
                    'state' => 'teste',
                    'city' => 'teste',
                    'nivel_id' => 2
                ]);
            }


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
    public function productForm()
    {
        return view('page.productForm');
    }
    public function productRegister(Request $request)
    {
        $customMessages = [
            'required' => 'O campo :attribute é obrigatório.',
            'numeric' => 'O :attribute selecionado é inválido.',
            'in' => 'O :attribute selecionado é inválido.',
        ];

        // Validação dos campos do formulário
        $validatedData = $request->validate([
            'brand' => 'required',
            'title' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required|numeric|int',
        ], $customMessages);

        // Obter o ID do vendedor autenticado
        $vendorId = Auth::id();

        // Criar uma instância do produto e definir os valores dos campos
        $product = new Product();
        $product->brand = $validatedData['brand'];
        $product->title = $validatedData['title'];
        $product->price = $validatedData['price'];
        $product->description = $validatedData['description'];
        $product->category = $validatedData['category'];
        $product->stock = $validatedData['stock'];
        $product->vendor_id = $vendorId;

        // Processar e salvar as imagens
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            // Verificar se há pelo menos 1 imagem e no máximo 3 imagens
            if (count($images) >= 1 && count($images) <= 3) {

                // Obter a data atual
                $currentDate = date('Y-m-d');

                // Criar o diretório de destino se não existir
                $directory = public_path('produtos/' . $currentDate);
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Definir um nome único para cada imagem e salvá-las no diretório de destino
                $imagePaths = [];

                foreach ($images as $index => $image) {
                    $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
                    $imagePath = $directory . '/' . $imageName;

                    Image::make($image)->resize(800, 600)->save($imagePath);

                    // Gerar o link completo da imagem
                    $imageLink = asset('produtos/' . $currentDate . '/' . $imageName);

                    // Salvar o link da imagem na coluna correspondente no banco de dados
                    $columnName = 'image' . ($index + 1);
                    $product->$columnName = $imageLink;

                    $imagePaths[] = $imagePath;
                }

                // Salvar o produto no banco de dados
                $product->save();

                // Redirecionar para uma página de sucesso ou exibir uma mensagem
                return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Erro: Por favor, envie pelo menos 1 imagem e no máximo 3 imagens.');
            }
        }
    }
    public function sales()
    {
        $sellerId = Auth::id();
        $purchases = Purchase::select('product_id', DB::raw('SUM(quantity)'));
        $sellerId = Auth::id();
        $purchases = Purchase::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total_price) as total_price'))
            ->where('seller_id', $sellerId)
            ->groupBy('product_id')
            ->get();


        return view('page.my-sales', compact('purchases'));
    }
}
