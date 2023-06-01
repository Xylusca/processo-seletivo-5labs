@extends('layouts.master')

@section('title', $product->title)
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-5">
            @include('partials/message')
        </div>
    </div>
    @include('partials/show-product')

@endsection
