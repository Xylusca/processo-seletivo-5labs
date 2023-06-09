@extends('layouts.master')

@section('title', 'Login')


@section('content')
    <div class="background-image-container">
        <div class="container-fluid px-1 mx-auto">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-sm-9 shadow p-5 border">
                    <div class="card-register bg-white">
                        <div class="text-center">
                            <h3 class="text-center fw-bold">Entrar na Store</h3>
                        </div>
                        <form class="form-card mt-5" action="{{ route('logar') }}" method="POST">
                            @csrf
                            <div class="row g-3">

                                {{-- message --}}
                                @include('partials.message')

                                <div class="col-md-12 form-outline">
                                    <input type="text" class="form-control" name="email" placeholder="E-mail"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="col-md-12 form-outline">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" value="{{ old('password') }}">
                                </div>
                                <a href="{{  route('reset.form') }}" class="text-dark">Esqueci a senha</a>

                                <div class="col-12">
                                    <div class="text-end">
                                        <button class="btn btn-primary btn-md fs-5 py-2 fw-bold rounded ms-3"
                                            type="submit">Entrar</button>
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
