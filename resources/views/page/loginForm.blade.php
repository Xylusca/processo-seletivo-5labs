@extends('layouts.master')

@section('title', 'Cadastros')


@section('content')
    <div class="background-image-container">
        <div class="container-fluid px-1 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-9 shadow p-5 border">
                    <div class="card-register bg-white">
                        <div class="text-center">
                            <h3 class="text-center fw-bold">Criar uma nova conta</h3>
                            <p>É rápido e fácil.</p>
                        </div>
                        <form class="form-card mt-5" action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                {{-- Se houver erros, exibe a mensagem de erro --}}
                                @if ($errors->any())
                                    <div class="col-12">
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif

                                {{-- Cadastrado com sucesso --}}
                                @if (session('success'))
                                    <div class="col-12">
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" name="name" placeholder="Nome"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" id="cpf" name="cpf"
                                        placeholder="CPF" value="{{ old('cpf') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" id="birthdate" name="birthdate"
                                        placeholder="Aniversário" value="{{ old('birthdate') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" name="state" placeholder="Estado"
                                        value="{{ old('state') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" name="city" placeholder="Cidade"
                                        value="{{ old('city') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="text" class="form-control" name="email" placeholder="E-mail"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <input type="password" class="form-control" name="password" placeholder="password"
                                        value="{{ old('password') }}">
                                </div>
                                <div class="col-md-6 form-outline">
                                    <select type="text" class="form-control" name="users" placeholder="users"
                                        value="{{ old('users') }}">
                                        <option selected>Menu de seleção</option>
                                        <option value="1">Comprador</option>
                                        <option value="2">Vendedor</option>
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-md-2 ms-auto text-end">
                                        <button class="btn btn-primary btn-md fs-5 py-2 fw-bold rounded ms-3"
                                            type="submit">Cadastrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('999.999.999-99');
            $('#birthdate').mask('99/99/9999');
        });
    </script>
@endsection
