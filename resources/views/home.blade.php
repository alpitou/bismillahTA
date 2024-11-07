@extends('layouts.main')

@section('container')

<!-- Header Start -->
<div class="container-fluid hero-header py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h1 class="display-5 mb-3 animated slideInDown">Sistem Informasi Penyuratan dan Arsip Dokumen</h1>
                <h2 class="h4 mb-4 animated slideInDown">Inspektorat Kota Jambi</h2>
                <p class="animated slideInDown">
                    Sistem ini dirancang untuk memudahkan pengelolaan surat dan arsip dokumen secara efisien di lingkungan Inspektorat Kota Jambi. Fitur utama mencakup pencatatan surat, penyimpanan arsip, dan pengelolaan dokumen dalam format PDF, yang dapat diakses dan dicetak sesuai kebutuhan.
                </p>
                <a href="/dashboard" class="btn btn-primary py-3 px-4 animated slideInDown">Mulai Mengelola Surat</a>
            </div>

            <div class="col-lg-5 text-end">
                <img class="img-fluid logo-image animated fadeIn" src="{{ asset('img/image.png') }}" alt="KOTA JAMBI">
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

@endsection

<!-- CSS Tambahan untuk Styling -->
<style>
    @font-face {
    font-family: 'Sequel Sans Display Heavy';
    src: url('D:\governance\sequel-sans-heavy-display_freefontdownload_org') ,
         url('D:\governance\sequel-sans-heavy-display_freefontdownload_org') ;
    font-weight: bold;
    font-style: bold;
}

    body, .display-5, .h4, .btn, .nav-link, .navbar-brand h2, .dropdown-menu .dropdown-item {
        font-family: 'Sequel Sans Display Heavy', sans-serif !important;
    }
    .hero-header {
        background-color: #fff; 
    }
    .display-5 {
        font-weight: bold;
        color: #000; 
    }
    .text-secondary {
        font-weight: 600;
        color: #6c757d;
    }
    .btn-primary {
        background-color: #db3949 !important; 
        border: none;
    }
    .btn-primary:hover {
        background-color: #c22d3d !important;
    }
    .logo-image {
        max-width: 100%;
        height: auto;
    }
</style>
