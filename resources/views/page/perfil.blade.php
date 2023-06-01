@extends('layouts.master')

@section('title', 'Perfil')


@section('content')
    <div class="background-image-container">
        <div class="container-fluid px-1 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-sm-11 shadow p-5 border">
                    <div class="card-register bg-white">
                        <div class="text-center">
                            <h3 class="text-center fw-bold">Editar Meu Perfil</h3>
                        </div>
                        <form action="{{ route('profile.update') }}" method="POST" class="row g-3">
                            @csrf
                            {{-- message --}}
                            @include('partials.message')

                            <div class="form-group col-md-6">
                                <label for="name">Nome:</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                                    required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpf">CPF:</label>
                                <input type="text" name="cpf" id="cpf"
                                    class="form-control @error('cpf') is-invalid @enderror" value="{{ $user->cpf }}"
                                    disabled>
                            </div>
                            <div class="form-group col-md-9">
                                <label for="email">E-mail:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}"
                                    required>
                            </div>
                            <div class="form-group col-md-3">
                                <a href="{{ route('email.enviar') }}" class="btn btn-secondary form-control mt-4">Verificar E-mail</a>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">Nascimento:</label>
                                <input type="text" name="birthdate" id="birthdate"
                                    class="form-control @error('birthdate') is-invalid @enderror"
                                    value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $user->birthdate)->format('d/m/Y') }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">Estado:</label>
                                <input type="text" name="state" id="state"
                                    class="form-control @error('state') is-invalid @enderror" value="{{ $user->state }}"
                                    required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city">Cidade:</label>
                                <input type="text" name="city" id="city"
                                    class="form-control @error('city') is-invalid @enderror" value="{{ $user->city }}"
                                    required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="new_password">Nova Senha:</label>
                                <input type="password" name="new_password" id="new_password"
                                    class="form-control @error('new_password') is-invalid @enderror">
                                <p class="text-info">Se deseja alterar sua senha, preencha o campo <strong>'Nova
                                        Senha'</strong> com a
                                    senha desejada. Caso contrário, deixe o campo em branco para manter sua senha
                                    atual.</p>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="text-end">
                                    <button class="btn btn-primary btn-md fs-5 py-2 fw-bold rounded ms-3"
                                        type="submit">Entrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
