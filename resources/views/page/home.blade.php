@extends('layouts.master')

@section('title', 'Home')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')
    <!-- Exibir a Pesquisa -->
    @include('partials/search')
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <!-- Exibir a Produtos -->
        @foreach ($products as $product)
            @include('partials/product')
        @endforeach
    </div>

    <!-- Exibir a paginação -->
    @include('partials/pagination')
@endsection
