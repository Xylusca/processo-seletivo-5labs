@extends('layouts.master')

@section('title', 'Esqueci senha')


@section('content')
    <div class="background-image-container">
        <div class="container-fluid px-1 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-6 shadow p-5 border">
                    <div class="card-register bg-white">
                        <div class="text-center">
                            <img src="{{ asset('img/password.png') }}" alt="computador" class="col-3">
                            <p class="mt-3">Cadastrar nova senha.</p>
                        </div>
                        <form class="form-card mt-3" action="{{ route('register.password') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- message --}}
                                @include('partials.message')

                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="col-md-12 form-outline">
                                    <input type="password" class="form-control" name="password" placeholder="Nova Senha:">
                                </div>
                                <div class="col-md-12 form-outline">
                                    <input type="password" class="form-control" name="password_confirmation"
                                        placeholder="Confirmar Nova Senha:">
                                </div>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary btn-md fs-5 py-2 fw-bold rounded ms-3"
                                            type="submit">Redefinir Senha</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
