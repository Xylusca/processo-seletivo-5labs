@extends('layouts.master')

@section('title', $product->title)
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Exibir a Pesquisa -->
    @include('partials/search')

    @include('partials/show-product')
@endsection
