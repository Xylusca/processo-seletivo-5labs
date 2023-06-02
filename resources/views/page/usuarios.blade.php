@extends('layouts.master')

@section('title', 'Consulta de Usuarios')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('content')

    <!-- Exibir a Pesquisa -->
    @include('partials/search')

    <!-- Filtro de usuario -->
    <div class="d-flex ms-3 justify-content-end flex-column flex-md-row mb-3">

        <!-- Filtro de Tipo -->
        <div class="mb-2 mb-md-0 d-flex">
            <span class="me-1 fw-bold">Tipo</span>
            <div class="dropdown">
                <span class="dropdown-toggle dropdown-toggle-split" id="tipoDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if ($tipo)
                        {{ $nivelNames[$tipo] }}
                    @else
                        Todos
                    @endif
                </span>
                <div class="dropdown-menu">
                    <a class="dropdown-item{{ empty($tipo) ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['tipo' => '']) }}">Todos</a>
                    <a class="dropdown-item{{ $tipo === '1' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['tipo' => '1']) }}">Comprador</a>
                    <a class="dropdown-item{{ $tipo === '2' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['tipo' => '2']) }}">Vendedor</a>
                    <a class="dropdown-item{{ $tipo === '3' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['tipo' => '3']) }}">Administrador</a>
                </div>
            </div>
        </div>

        <!-- Filtro de Status -->
        <div class="mb-2 mb-md-0 d-flex">
            <span class="me-1 fw-bold">Status por</span>
            <div class="dropdown">
                <span class="dropdown-toggle dropdown-toggle-split" id="orderDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if ($status)
                        {{ $status }}
                    @else
                        Todos
                    @endif
                </span>
                <div class="dropdown-menu">
                    <a class="dropdown-item{{ empty($status) ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['status' => '']) }}">Todos</a>
                    <a class="dropdown-item {{ $status === 'pendente' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['status' => 'pendente']) }}">Pendente</a>
                    <a class="dropdown-item  {{ $status === 'ativo' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['status' => 'ativo']) }}">Ativo</a>
                </div>
            </div>
        </div>

        <!-- Filtro de orden -->
        <div class="mb-2 mb-md-0 d-flex">
            <span class="me-1 fw-bold">Ordenar por</span>
            <div class="dropdown">
                <span class="dropdown-toggle dropdown-toggle-split" id="orderDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    @if ($order)
                        {{ $order }}
                    @else
                        Registro
                    @endif
                </span>
                <div class="dropdown-menu">
                    <a class="dropdown-item{{ empty($order) ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['order' => '']) }}">Registro</a>
                    <a class="dropdown-item {{ $order === 'maior-credito' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['order' => 'maior-credito']) }}">Maior
                        crédito</a>
                    <a class="dropdown-item {{ $order === 'menor-credito' ? ' active' : '' }}"
                        href="{{ request()->fullUrlWithQuery(['order' => 'menor-credito']) }}">Menor
                        crédito</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($users as $user)
                @include('partials/usuario')
            @endforeach
        </div>
    </div>
@endsection
