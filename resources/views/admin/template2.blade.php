<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- CSS Files -->
    <link href="{{ asset('css/adminlte.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" /> <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <style>
        /* Membuat teks lebih kecil */
.nav-link p {
    font-size: 12px; /* Atur ukuran font teks */
    margin-top: 5px; /* Jarak antara ikon dan teks */
}

/* Menambah ukuran ikon */
 .nav-sidebar .nav-item .nav-link .fa-3x {
    font-size: 3rem; /* Membesarkan ikon */
}

/* Mengatur alignment teks di bawah ikon */
.nav-link {
    text-align: center; /* Menyusun teks di bawah ikon */
    display: flex;
    flex-direction: column;
    align-items: center;
}

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="custom-body-pd" >
    <div class="wrapper">
        
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="sideToggle" data-widget="pushmenu"  role="button"><i class="fas fa-bars" id="header-toggle"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
      
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 accordion" id="accordionSidebar">
            <!-- Brand Logo -->
            <a href="#" class="brand-link text-center">
                <img src="{{ asset('images/trinity.jpg') }}" alt="Logo" class="brand-image img-circle elevation-3" style="border: 2px solid #ecf0f1;" />
                <span class="brand-text font-weight-bold">Menu Resep Makanan</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar Menu -->
                <nav  style="margin-top: 8rem; margin-left:auto">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ url('/admin/menus') }}" class="nav-link  text-center">
                                <i class="nav-icon fas fa-utensils fa-3x"></i> <!-- Perbesar ikon -->
                                <p class="text-sm">Tabel Data Menu</p> <!-- Kecilkan teks -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/categories') }}" class="nav-link text-center">
                                <i class="nav-icon fas fa-th fa-3x"></i> <!-- Perbesar ikon -->
                                <p class="text-sm">Tabel Kategori</p> <!-- Kecilkan teks -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/admin/recipes') }}" class="nav-link text-center">
                                <i class="nav-icon fas fa-book fa-3x"></i> <!-- Perbesar ikon -->
                                <p class="text-sm">Tabel Resep</p> <!-- Kecilkan teks -->
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <h1 class="m-0">@yield('page-title', 'Dashboard')</h1>
            </div>

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; 2024 <a href="#">Your Company</a></strong>. All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    
    <script src="{{asset('')}}"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function (event) {
         const showNavbar = (toggleId, navId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId)
           

        // Validasi bahwa semua elemen ada
        if (toggle && nav) {
            toggle.addEventListener('click', () => {
                // Tampilkan navbar
                nav.classList.toggle('show');
                // Ubah ikon
                toggle.classList.toggle('bx-x');
                // Tambahkan padding ke body
                
            });
        }
    };

    // Sesuaikan dengan id baru
    showNavbar('custom-header-toggle', 'custom-nav-bar'); 

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.custom-nav-link');

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        }
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink));
});

    </script>
</body>

</html>
