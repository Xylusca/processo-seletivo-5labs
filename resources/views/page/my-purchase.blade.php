@extends('layouts.master')

@section('title', 'Minhas Compras')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection


@section('content')
    <!-- Exibir a Pesquisa -->
    @include('partials/search')

    <!-- Exibir a filtro -->
    @include('partials/filter')

    @foreach ($purchases as $purchase)
        @include('partials/purchase')
    @endforeach

@endsection
