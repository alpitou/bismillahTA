@extends('layouts.main')

@section('container')
<div class="row justify-content-center mt-0 mb-0">
    <div class="col-md-8 d-flex align-items-center">

        <div class="col-md-6 text-center border-end pe-5">
            <div class="logo-container">
            <img src="{{ asset('img/image.png') }}" alt="KOTA JAMBI" class="logo-image">
            </div>
        </div>

        <div class="col-md-8 text-end d-flex flex-column justify-content-end" style="padding-right: 10px; padding-top: 0;">
            <h2 class="text-title mb-1">SISTEM INFORMASI PENYURATAN</h2>
            <h2 class="text-title mb-4">DAN ARSIP DOKUMEN INSPEKTORAT KOTA JAMBI</h2>

            <main class="form-signin">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('loginError') }}
                    </div>
                @endif

                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Username" autofocus required value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Login</button>
                </form>
            </main>
        </div>

    </div>
</div>

<style>
    @font-face {
        font-family: 'Sequel Sans Display Heavy';
        src: url('/path/to/fonts/SequelSansDisplayHeavy.woff2') format('woff2'),
             url('/path/to/fonts/SequelSansDisplayHeavy.woff') format('woff');
        font-weight: bold;
        font-style: normal;
    }

    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .logo-image {
        max-width: 100%;
    }
    .text-title {
        font-family: 'Sequel Sans Display Heavy', sans-serif;
        font-weight: bold;
        font-size: 1.2rem;
        color: #333;
        text-align: center;
    }
    .btn-primary {
        background-color: #db3949;
        border-color: #db3949;
    }
    .btn-primary:hover {
        background-color: #c22d3d;
        border-color: #c22d3d;
    }
    .form-control:focus {
        border-color: #000; 
        box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.25);
    }
    .form-floating > label {
        color: #000;
    }
    .form-floating > .form-control {
        color: #000;
    }
</style>
@endsection
