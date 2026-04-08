@extends('layouts.app')

@section('sidebar')
    <div class="p-3 bg-white border shadow-sm mb-4 rounded-0">
        <h5 class="fw-bold mb-3 border-bottom pb-2">تصفية النتائج</h5>
        
        
        <div class="mb-4">
            <h6 class="fw-bold text-muted small mb-3 text-uppercase">الأقسام</h6>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <a href="{{ route('shop.index') }}" class="text-decoration-none {{ !request('category') ? 'fw-bold text-primary' : 'text-dark' }}">
                        <i class="fas fa-th-large me-2 small"></i> الكل
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('shop.index', ['category' => 1]) }}" class="text-decoration-none {{ request('category') == 1 ? 'fw-bold text-primary' : 'text-dark' }}">
                        <i class="fas fa-clock me-2 small"></i> ساعات كلاسيك
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('shop.index', ['category' => 2]) }}" class="text-decoration-none {{ request('category') == 2 ? 'fw-bold text-primary' : 'text-dark' }}">
                        <i class="fas fa-mobile-alt me-2 small"></i> ساعات ذكية
                    </a>
                </li>
            </ul>
        </div>

       
        <div class="mb-4 border-top pt-3">
            <h6 class="fw-bold text-muted small mb-3 text-uppercase">التقييم</h6>
            <div class="text-warning small mb-2">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>
                <span class="text-dark ms-1">4.0 فما فوق</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    
    @php
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
    @endphp

    <style>
        .udemy-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            cursor: pointer;
            border: 1px solid #eee !important;
            border-radius: 0 !important;
        }
        .udemy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.1) !important;
        }
        .card-img-container {
            overflow: hidden;
            position: relative;
        }
        .card-img-top {
            transition: transform 0.5s ease;
        }
        .udemy-card:hover .card-img-top {
            transform: scale(1.1);
        }
        .btn-udemy-primary {
            background-color: #2d2f31;
            color: white;
            font-weight: bold;
            border-radius: 0 !important;
            transition: background 0.2s;
        }
        .btn-udemy-primary:hover {
            background-color: #1c1d1f;
            color: white;
        }
        .btn-udemy-outline {
            border: 1px solid #2d2f31;
            color: #2d2f31;
            font-weight: bold;
            border-radius: 0 !important;
        }
    </style>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            @if(request('search'))
                نتائج البحث عن: "{{ request('search') }}"
            @else
                اكتشفي مجموعتنا المختارة
            @endif
        </h4>
        <p class="text-muted small mb-0">تم العثور على {{ $products->count() }} ساعة</p>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card udemy-card h-100 border-0 shadow-sm">
                <div class="card-img-container">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @if($loop->first && !request('category'))
                        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 shadow-sm">Bestseller</span>
                    @endif
                </div>

                <div class="card-body p-3 d-flex flex-column">
                    <h6 class="card-title fw-bold mb-1 text-dark text-truncate">{{ $product->name }}</h6>
                    <p class="text-muted small mb-1">{{ $product->brand ?? 'Special Edition' }}</p>
                    
                    <div class="text-warning small mb-2 d-flex align-items-center">
                        <span class="fw-bold text-dark me-1">4.8</span>
                        <div class="me-1">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-muted small">(3,450)</span>
                    </div>

                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="fw-bold fs-5 text-dark">{{ number_format($product->price, 2) }} EGP</span>
                        <span class="text-muted text-decoration-line-through small">{{ number_format($product->price + 350, 2) }} EGP</span>
                    </div>

                    <div class="mt-auto">
                        <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-udemy-outline w-100 py-2 mb-2">
                            View Details
                        </a>

                        @if(isset($cart[$product->id]))
                            <a href="{{ route('cart.index') }}" class="btn btn-primary w-100 py-2 rounded-0 shadow-sm">
                                <i class="fas fa-shopping-cart me-1"></i> Go to Cart
                            </a>
                        @else
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-udemy-primary w-100 py-2">
                                Add to Cart
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <p>عذراً، لم نجد أي ساعات تطابق بحثك.</p>
            </div>
        @endforelse
    </div>
@endsection