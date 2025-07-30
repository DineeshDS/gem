@extends('layouts.auth')

@section('page-title', 'Login')

@section('content')

    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="{{ url('assets/images/logo.png') }}" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">Sign In</h1>
                                    <p class="text-muted">Sign in to Gem</p>
                                </div>
                                <form class="mb-5" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required autocomplete="current-password">
                                        @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="text-center text-lg-start">
                                        @if (Route::has('password.request'))
                                            <p class="small">Can't access your account? <a href="{{ route('password.request') }}">Reset your password now</a>.</p>
                                        @endif
                                        <button class="btn btn-primary">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo" style="margin-top: 70px;">
                            <img width="300" src="{{ url('assets/images/logo.png') }}" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold">Welcome to GEMGEM!</h3>
                            <p class="lead my-5">If you don't have an account, would you like to register right now?</p>
                            <a href="#" class="btn btn-primary">Sign Up</a>
                        </div>
                        <ul class="list-inline">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
