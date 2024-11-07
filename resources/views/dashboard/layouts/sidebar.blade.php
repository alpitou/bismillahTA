<!-- Sidebar Start -->
<div class="sidebar pe-100 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="/" class="navbar-brand mx-5 mb-3 text-center">
            <img src="{{ asset('img/image.png') }}" alt="iconWeb" width="100px">
        </a>
        
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('dashmin/img/user.png') }}" alt="User Image" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                <span>{{ auth()->user()->username }}</span>
            </div>
        </div>

        <div class="navbar-nav w-100">
            <a href="/dashboard" class="nav-item nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                <i class="fa fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ Request::is('domisili') || Request::is('usaha') ? 'active' : '' }}" data-bs-toggle="dropdown">
                    <i class="far fa-file-alt me-2"></i>Surat
                </a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/dashboard/domisili" class="dropdown-item {{ Request::is('dashboard/domisili*') ? 'active' : '' }}">
                        <i class="bi bi-house"></i> Ket Domisili
                    </a>
                    <a href="/dashboard/usaha" class="dropdown-item {{ Request::is('dashboard/usaha*') ? 'active' : '' }}">
                        <i class="bi bi-shop-window"></i> Ket Usaha
                    </a>
                </div>
            </div>
        </div>

        <!-- Kondisi untuk Role Inspektur -->
        @if(auth()->user()->hasRole('Inspektur'))
        <div class="navbar-nav w-100">
            
            <a href="/pegawai" class="nav-item nav-link {{ Request::is('pegawai.index') ? 'active' : '' }}"><i class="fa fa-users me-2"></i>Pegawai</a>
            <!-- <a href="{{ route('surat.index') }}" class="nav-item nav-link"><i class="fa fa-envelope me-2"></i>Kelola Surat Jalan & Izin</a> -->
            <!-- <a href="/dashboard/komentar" class="nav-item nav-link {{ Request::is('dashboard/komentar*') ? 'active' : '' }}">
            <i class="bi bi-shop-window"></i> Komentar -->
            <!-- <a href="{{ route('dokumen.index') }}" class="nav-item nav-link"><i class="fa fa-file me-2"></i>Kelola Dokumen Pegawai</a> -->
        </div>
        @endif
    </nav>
</div>
<!-- Sidebar End -->

<!-- CSS untuk styling -->
<style>
    .sidebar {
        width: 225px; /* Lebar sidebar */
        background-color: #f8f9fa; /* Warna latar belakang */
        height: 100vh; /* Tinggi penuh */
        position: fixed; /* Tetap di tempat saat scroll */
    }
    .navbar-brand img {
        margin-bottom: 10px; /* Jarak antara gambar dan teks */
    }
    .d-flex.align-items-center {
        padding: 10px 15px; /* Padding profil pengguna */
    }
    .navbar-brand h3 {
        font-family: 'Sequel Sans Display Heavy', sans-serif;
        font-size: 1.5rem; /* Ukuran teks */
    }
    .navbar-nav .nav-link {
        font-family: 'Sequel Sans Display Heavy', sans-serif;
        font-size: 1rem; /* Ukuran teks */
        margin-bottom: 10px; /* Jarak antar item navigasi */
    }
    .navbar-nav .nav-link i {
        margin-right: 10px; /* Jarak antara ikon dan teks */
    }
    .dropdown-menu .dropdown-item {
        font-family: 'Sequel Sans Display Heavy', sans-serif;
        font-size: 0.9rem; /* Ukuran teks dropdown */
    }
    .dropdown-menu .dropdown-item i {
        margin-right: 10px; /* Jarak antara ikon dan teks di dropdown */
    }
    .text-muted {
        font-family: 'Sequel Sans Display Heavy', sans-serif;
        font-size: 1rem; /* Ukuran teks heading */
    }
</style>

<!-- Load Font Awesome untuk ikon -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Load Bootstrap Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
