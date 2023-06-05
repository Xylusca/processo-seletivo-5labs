@extends('layouts.master')

@section('title', 'Minhas Compras')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection


@section('content')
    @foreach ($purchases as $purchase)
    @if (!isset($purchase->skip) || !$purchase->skip)
        @include('partials.purchase')
    @endif
@endforeach

@endsection
