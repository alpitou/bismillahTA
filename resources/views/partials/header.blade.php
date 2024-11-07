<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-dark" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a href="/" class="navbar-brand d-flex align-items-center">
        <h2 class="m-0 text-dark"><img alt="" style="width: 45px;">SIPAD Inspektorat Kota Jambi</h2>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-4 py-lg-0">
            <a href="/" class="nav-item nav-link text-custom {{ Request::is('/') ? 'active' : '' }}">Home</a>
            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</a>
                    <div class="dropdown-menu shadow-sm m-0">
                        <a href="/dashboard" class="dropdown-item"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard</a>
                        <hr class="dropdown-divider">
                        <form action="/logout" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="/login" class="nav-item nav-link text-dark {{ Request::is('login') || Request::is('register') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            @endauth
        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- CSS Tambahan -->
<style>
    @font-face {
    font-family: 'Sequel Sans Display Heavy';
    src: url('D:\governance\sequel-sans-heavy-display_freefontdownload_org') ,
         url('D:\governance\sequel-sans-heavy-display_freefontdownload_org') ;
    font-weight: bold;
    font-style: bold;
}

    body, .nav-link, .navbar-brand h2, .dropdown-menu .dropdown-item, .btn {
        font-family: 'Sequel Sans Display Heavy', sans-serif !important; 
    }
    .nav-link {
        color: #000 !important; 
    }
    .navbar-brand h2 {
        color: #000 !important; 
    }
    .navbar-nav .nav-item .nav-link.active {
        font-weight: bold; 
    }
    .text-custom {
        color: #db3949 !important; 
    }
    .text-custom:hover {
        color: #c22d3d !important;
    }
</style>
