<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Portal Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        /* Futuristic Navbar */
        .navbar-futuristic {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-bottom: 1px solid rgba(255, 255, 255, 0.18);
            padding: 1rem 0;
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            transition: all 0.3s;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            text-shadow: 0 0 20px rgba(255,255,255,0.8);
        }
        
        /* Modern Search in Navbar */
        .navbar-search {
            flex: 1;
            max-width: 450px;
            margin: 0 2rem;
        }
        
        .search-input-navbar {
            border-radius: 30px;
            border: 2px solid rgba(255,255,255,0.4);
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        
        .search-input-navbar::placeholder {
            color: rgba(255,255,255,0.8);
        }
        
        .search-input-navbar:focus {
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            border-color: white;
            box-shadow: 0 0 20px rgba(255,255,255,0.5), 0 0 40px rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
        }
        
        .search-btn-navbar {
            border-radius: 30px;
            border: 2px solid rgba(255,255,255,0.4);
            background: rgba(255, 255, 255, 0.25);
            color: white;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
            backdrop-filter: blur(10px);
        }
        
        .search-btn-navbar:hover {
            background: white;
            color: #667eea;
            border-color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        
        /* Nav Links */
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 20px;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .navbar-nav .nav-link:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
            z-index: -1;
        }
        
        .navbar-nav .nav-link:hover:before {
            left: 0;
        }
        
        .navbar-nav .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.5);
            background: rgba(255, 255, 255, 0.1);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        /* Footer Modern */
        footer {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-top: 60px;
        }
        
        footer h5, footer p {
            color: white;
        }
        
        footer .text-success {
            color: #f093fb !important;
        }
        
        /* Berita Card */
        .berita-card {
            transition: all 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .berita-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            transition: all 0.3s;
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .bg-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        
        @media (max-width: 991px) {
            .navbar-search {
                margin: 1rem 0;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-futuristic">
        <div class="container">
            <!-- Logo Portal Desa -->
            <a class="navbar-brand" href="/">
                <i class="bi bi-cpu-fill"></i> Portal Desa
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Search Bar di Tengah -->
                <div class="navbar-search">
                    <form action="{{ route('berita.index') }}" method="GET" class="d-flex">
                        <input type="text" 
                               class="form-control search-input-navbar me-2" 
                               name="search" 
                               placeholder="🔍 Cari berita..." 
                               value="{{ request('search') }}"
                               autocomplete="off">
                        <button class="btn search-btn-navbar" type="submit">
                            Cari
                        </button>
                    </form>
                </div>
                
                <!-- Menu Kanan -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('berita.index') }}">Berita</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-cpu-fill text-success"></i> Portal Desa</h5>
                    <p class="text-white-50">Informasi dan berita terkini dari desa kami</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-white-50 mb-0">&copy; {{ date('Y') }} Portal Desa. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>