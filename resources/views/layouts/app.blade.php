<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY STORE PRO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body { 
            background-color: #f8f9fa !important; 
            color: #1c1d1f; 
            font-family: 'Segoe UI', Tahoma, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .navbar { 
            background: #fff !important; 
            border-bottom: 1px solid #d1d7dc; 
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .udemy-card {
            background: #fff;
            border: 1px solid #d1d7dc !important;
            border-radius: 0 !important;
            transition: 0.3s;
            height: 100%;
        }
        .udemy-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-udemy {
            background-color: #a435f0 !important;
            color: white !important;
            border-radius: 0 !important;
            font-weight: bold;
            padding: 10px;
            border: none;
            width: 100%;
        }
        .btn-udemy:hover {
            background-color: #8710d8 !important;
        }

        aside {
            background: #fff;
            padding: 20px;
            border-left: 1px solid #d1d7dc;
            min-height: 100vh;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white shadow-sm">
    <div class="container-fluid px-4">
        <a class="navbar-brand fw-bold fs-3" href="/">MY STORE <span class="text-primary">PRO</span></a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <form action="{{ route('shop.index') }}" method="GET" class="d-flex align-items-center flex-grow-1 mx-lg-5 my-2 my-lg-0 position-relative">
                <input type="text" name="search" class="form-control rounded-pill ps-4" placeholder="ابحث عن ساعتك المفضلة..." value="{{ request('search') }}" style="border: 1px solid #1c1d1f;">
                <button type="submit" class="btn btn-link text-dark position-absolute end-0 me-2">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fs-4"></i>
                        @php 
                            $cart = json_decode(request()->cookie('shopping_cart'), true) ?: [];
                            $cartCount = count($cart);
                        @endphp
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </li>

               
                @auth
                 
                    @if(Auth::user()->role == 'admin')
                        <li class="nav-item me-2">
                            <a class="nav-link btn btn-outline-dark px-3 fw-bold" href="{{ route('products.index') }}" style="border-radius: 5px;">
                                لوحة التحكم
                            </a>
                        </li>
                    @endif

                  
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger px-3 fw-bold" style="border-radius: 5px;">
                                <i class="fas fa-sign-out-alt"></i> خروج
                            </button>
                        </form>
                    </li>
                @endauth

              
                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark me-2" href="{{ route('login') }}">تسجيل دخول</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary px-4 fw-bold" href="{{ route('register') }}" style="border-radius: 5px;">إنشاء حساب</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

    <div class="container-fluid mt-4">
        <div class="row">
            @if(View::hasSection('sidebar'))
                <aside class="col-md-3 d-none d-md-block">
                    @yield('sidebar')
                </aside>
                <main class="col-md-9 px-4">
            @else
                <main class="col-md-12 px-5">
            @endif
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>