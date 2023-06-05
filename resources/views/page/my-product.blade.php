@extends('layouts.master')

@section('title', 'Minhas Compras')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <h1>Meus Produtos</h1>

    @if ($products->count() > 0)
        @foreach ($products as $product)
            <div class="container mb-4">
                <div class="d-flex justify-content-center row">
                    <div class="col-md-12">
                        <div class="row p-2 bg-white border rounded">
                            <div class="col-md-3 mt-1">
                                <img class="img-fluid img-responsive rounded product-image" src="{{ $product->image1 }}"
                                    alt="{{ $product->title }}">
                            </div>
                            <div class="col-md-6 mt-1">
                                <h5>{{ $product->title }}</h5>
                                <div class="mt-1 mb-1 spec-1">
                                    <span>{{ $product->description }}.</span><br>
                                    <span>Vendido por <strong>{{ $product->user->name }}</strong></span><br>
                                    <span class="text-primary">Estoque: {{ $product->stock }}</span><br>
                                </div>
                            </div>
                            <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                <div class=" flex-row align-items-center">
                                    <h4 class="strike-text">R$ {{ number_format($product->price, 2, ',', '') }}</h4>
                                </div>
                                <div class="d-flex flex-column mt-4">
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                        class="btn btn-primary btn-sm" type="button">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>Nenhum produto encontrado.</p>
    @endif
@endsection
