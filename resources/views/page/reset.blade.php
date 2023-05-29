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
                            <p class="mt-3">Insirar o E-mail e CPF para recuperar a senha.</p>
                        </div>
                        <form class="form-card mt-3" action="{{ route('reset.enviar')}} " method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- message --}}
                                @include('partials.message')

                                <div class="col-md-12 form-outline">
                                    <input type="text" class="form-control" name="email" placeholder="E-mail"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-md-12 form-outline">
                                    <input type="cpf" class="form-control" id="cpf" name="cpf"
                                        placeholder="CPF" value="{{ old('cpf') }}">
                                </div>


                                <div class="col-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary btn-md fs-5 py-2 fw-bold rounded ms-3"
                                            type="submit">Enviar</button>
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

