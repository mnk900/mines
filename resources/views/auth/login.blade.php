@extends('layouts.guest')
@section('content')
@section('title')
{{ 'Log in' }}
@endsection
<div class="login-box">
    <div class="login-logo">
        <a href="/">
            <img src="{{ asset('frontend/img/logo.png')}}" alt="Auth Logo" width="50" height="50">
            <span class="text-center"><b>{{ config('app.name') }}</b></span>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-header bg-gradient-success">
            <h3 class="card-title float-none text-center">
                Sign in to start your session </h3>
        </div>
        <div class="card-body login-card-body ">

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}"
                        required autofocus autocomplete="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope fa-lg text-success"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required
                        autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock fa-lg text-success"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-success">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
            <p class="mb-0 mt-2">
            Don't Have account? <a href="{{ route('home.register') }}" class="text-center">Register new account</a>
        </p> 
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endsection