<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <style>
        /* Styling untuk body dan layout */
        body {
            font-family: Arial, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 80px; /* Sidebar lebih kecil, hanya ikon */
            height: 100vh;
            background-color: #343a40; /* Warna gelap untuk sidebar */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #ffffff; /* Warna ikon */
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 60px;
            font-size: 1.5rem; /* Ukuran ikon */
            transition: all 0.3s ease;
            margin-bottom: 2.1rem;
            flex-direction:column;
            text-align: center;
            text-decoration: none;
        }
        .sidebar .nav-link p {
          margin: 0; /* Hilangkan margin bawaan */
          font-size: 15px; /* Sesuaikan ukuran font */
          color: #ffffff; /* Warna teks */
          visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            margin-left: 5px;
      }
        

        
        .sidebar .nav-link:hover {
            background-color: #17a2b8; /* Efek hover warna biru */
            color: #ffffff;
            transform: scale(1.2); /* Efek zoom */
        }
        .sidebar .nav-link:hover p{
          visibility: visible;
          opacity: 5;
        }
        /* Main content */
        .content-wrapper {
            margin-left: 80px; /* Sesuaikan dengan lebar sidebar */
            padding: 20px;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .nav-link {
            color: #343a40;
            font-size: 1.5rem;
            
        }

        .navbar .nav-link:hover {
            color: #17a2b8; /* Warna hover */
        }
        .brand-image {
          line-height: .8;
          margin-left: .8rem;
          margin-right: .5rem;
          margin-top: -3px;
          max-height: 65px;
          width: auto;
          float: left;
        }
        .img-circle{
          border-radius:50%;
        }
        .elevation-3 {
         box-shadow: 0 10px 20px rgba(0,0,0,.19),0 6px 6px rgba(0,0,0,.23) !important;
        }
        .content-wrapper .container-fluid-custom {
          display: -ms-flexbox;
          display: flex;
          -ms-flex-wrap: wrap;
          flex-wrap: wrap;
          -ms-flex-align: center;
          align-items: center;
          -ms-flex-pack: justify;
          justify-content: space-between;
}
    </style>
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
      <div style="margin-top:15rem; margin-bottom:15rem;">
        <a href="{{ url('/admin/menus') }}" class="nav-link" title="Menu">
            <i class="fas fa-utensils"></i><p>Menu</p>
        </a>
        <a href="{{ url('/admin/categories') }}" class="nav-link" title="Categories">
            <i class="fas fa-th"></i><p>Category</p>
        </a>
        <a href="{{ url('/admin/recipes') }}" class="nav-link" title="Recipes">
            <i class="fas fa-book"></i><p>Recipe</p>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light">
          <div class="container-fluid">
              <!-- Home di pojok kiri -->
              <a href="#" class="navbar-brand">
                <img src="{{ asset('images/resep.png') }}" alt="Logo" class="brand-image img-circle elevation-3" style="border: 2px solid #ecf0f1;" />
                <span class="brand-text font-weight-bold" style="line-height: 3">Dapur Resep</span>
              </a>
      
              <!-- Profile di pojok kanan -->
              <div class="d-flex ms-auto">
                <a href="{{ url('/logout') }}" class="nav-link mt-auto" title="Logout">
                  <i class="fas fa-sign-out-alt"></i>
              </a>
              </div>
          </div>
      </nav>
      

        <!-- Content -->
        <div class="container-fluid pt-3">
            <h1>@yield('page-title', 'Dashboard')</h1>
            <div>
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
