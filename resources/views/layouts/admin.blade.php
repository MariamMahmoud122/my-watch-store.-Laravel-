<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>My Store Pro | Udemy Style</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
       
        body { background-color: #f8f9fa; font-family: 'Cairo', sans-serif; }
        .navbar { background: #fff; border-bottom: 1px solid #d1d7dc; box-shadow: 0 2px 4px rgba(0,0,0,0.08); }
        .udemy-card { border: 1px solid #d1d7dc; transition: 0.3s; }
        .udemy-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4" href="{{ route('shop.index') }}">
            MY STORE <span class="text-primary">PRO</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('products.index') }}">كل الساعات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-primary fw-bold px-3" href="{{ route('products.create') }}">
                        <i class="fas fa-plus-circle me-1"></i> إضافة منتج
                    </a>
                </li>
            </ul>

            <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex align-items-center">
                <div class="input-group" style="width: 300px;">
                    <button class="btn btn-dark px-3" type="submit" style="border-radius: 0 20px 20px 0;">
                        <i class="fas fa-search"></i>
                    </button>
                    <input type="text" name="search" 
                           class="form-control border-secondary-subtle px-3" 
                           placeholder="ابحث عن أوردر..." 
                           value="{{ request('search') }}" 
                           style="border-radius: 20px 0 0 20px; font-size: 0.9rem;">    
                </div>

             
                @if(request('search'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-link text-danger ms-1 p-0" title="إلغاء البحث">
                        <i class="fas fa-times-circle fs-5"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>
</nav>

    <main class="py-5">
        @yield('content')
    </main>

    <footer class="text-center py-4 border-top bg-white mt-5">
        <p class="text-muted">جميع الحقوق محفوظة -   Watch-shop &copy; 2026</p>
    </footer>

</body>
</html>