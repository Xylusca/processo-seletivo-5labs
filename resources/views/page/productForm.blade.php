@extends('layouts.master')

@section('title', 'Cadastro de Produtos')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/formProduct.css') }}">
@endsection

@section('content')
    <form class="form-card mt-5" action="{{ route('product.register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="row border rounded shadow">
                        <div class="text-center mt-4">
                            <h3 class="text-center fw-bold">Criar seu nova produto</h3>
                            <p>É rápido e fácil.</p>

                        </div>

                        {{-- message --}}
                        @include('partials.message')

                        <div class="col-md-6">
                            <div class="images p-3">
                                <div class="text-center pt-4 ratio ratio-4x3">
                                    <p class="bg-secondary text-white pt-5 fs-5" width="340" height="400"
                                        alt="Imagem do produto">
                                        Sua imagem será exibida aqui.<br>
                                        Pode enviar até três imagens.
                                    </p>
                                </div>
                                <div class="thumbnail text-center mt-2">
                                    <input type="file" name="images[]" id="image-upload" accept="image/*" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 card-product rounded-end">
                            <div class="p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-long-arrow-alt-left"></i>
                                        <a href="{{ route('home') }}"
                                            class="ms-1 text-decoration-none text-dark fw-bold">Back</a>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <p class="me-2 m-0 p-0">
                                            <i class="fas fa-eye me-1"></i>
                                            Vizulizações
                                        </p>
                                        <i class="fa fa-shopping-cart text-muted"></i>
                                    </div>
                                </div>
                                <div class="mt-4 mb-3">
                                    <div class="input-wrapper col-md-10">
                                        <input type="text" class="form-control padrao fw-bold" name="brand"
                                            placeholder="Modelo do Produto:" value="{{ old('brand') }}">
                                    </div>

                                    <div class="input-wrapper col-md-10">
                                        <input type="text" class="form-control padrao fw-bold" name="title"
                                            value="{{ old('title') }}" placeholder="Titulo:">
                                    </div>
                                    <div class="flex-row align-items-center col-md-10">
                                        <div class="input-wrapper col-md-12">
                                            <input type="number" class="form-control padrao fw-bold success" name="price"
                                                value="{{ old('price') }}" placeholder="Preço:">
                                        </div>

                                    </div>
                                </div>
                                <div class="input-wrapper col-md-11">
                                    <textarea type="" class="form-control border-1 " name="description" placeholder="Descrição do Produto:"
                                        value="{{ old('description') }}"></textarea>
                                </div>
                                <div class="sizes mt-5">
                                    <h6 class="text-uppercase fw-bold">Características principais</h6>
                                    <div>
                                        <p class="my-0 ms-3">
                                            <strong>Vendedor:</strong>
                                            {{ Auth::user()->name }}
                                        </p>
                                        <div class="input-wrapper ms-3 col-md-8">
                                            <input type="text" class="form-control padrao fw-bold" name="category"
                                                placeholder="Categoria:" value="{{ old('category') }}">
                                        </div>

                                        <div class="input-wrapper ms-3 col-md-8">
                                            <input type="Number" class="form-control padrao fw-bold" name="stock"
                                                placeholder="Quantidade em Estoque:" value="{{ old('stock') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="cart mt-4 align-items-center">
                                    <button class="btn btn-primary text-uppercase mr-2 px-4">Salvar
                                        Produto</button>
                                    <i class="fa fa-heart text-muted mx-2"></i><i class="fa fa-share-alt text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
