@extends('layouts.app')



@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-primary fw-bold">الرئيسية</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-3">{{ $product->name }}</h1>
            <p class="fs-5 text-muted mb-4">{{ $product->description }}</p>

            <div class="d-flex align-items-center mb-4">
                <span class="badge bg-warning text-dark me-2">الأكثر تقييماً</span>
                <div class="text-warning me-2">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <span class="text-primary fw-bold">(4.9 تقييم)</span>
                <span class="ms-3 text-muted">5,000+ قطعة تم بيعها</span>
            </div>

            <div class="glass-card p-4 border mb-5 bg-white shadow-sm">
                <h4 class="fw-bold mb-4">ماذا ستجد في هذه الساعة؟ </h4>
                <div class="row">
                    <div class="col-md-6 mb-2"><i class="fas fa-check text-success me-2"></i> ماركة أصلية: {{ $product->details->brand }}</div>
                    <div class="col-md-6 mb-2"><i class="fas fa-check text-success me-2"></i> خامة فاخرة: {{ $product->details->material }}</div>
                    <div class="col-12 mt-3">
                        <h6 class="fw-bold">المميزات:</h6>
                        <p class="text-muted">{{ $product->details->features }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg border-0 sticky-top" style="top: 100px;">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-2 rounded-4">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <h2 class="fw-bold mb-0">{{ $product->price }} ج.م</h2>
                        <span class="text-muted text-decoration-line-through ms-2 fs-5">{{ $product->price + 500 }} ج.م</span>
                    </div>
                    <p class="text-danger fw-bold"><i class="far fa-clock me-1"></i> خصم لفترة محدودة!</p>
                    
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-udemy btn-lg w-100 mb-3 py-3">
    إضافة إلى السلة
</a>
                    <button class="btn btn-outline-dark w-100 py-2">اشتري الآن</button>
                    
                    <ul class="list-unstyled text-start mt-4 small">
                        <li class="mb-2"><i class="fas fa-undo me-2"></i> ضمان استرجاع لمدة 14 يوم</li>
                        <li class="mb-2"><i class="fas fa-shipping-fast me-2"></i> شحن سريع لكل المحافظات</li>
                        <li class="mb-2"><i class="fas fa-certificate me-2"></i> شهادة ضمان معتمدة</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-5 opacity-10">

<div class="container pb-5">
    <h3 class="fw-bold mb-4">ساعات قد تعجبك أيضاً </h3>
    <div class="row g-4">
        @forelse($relatedProducts as $related)
            <div class="col-md-3">
                <a href="{{ route('shop.product.show', $related->id) }}" class="text-decoration-none text-dark">
                    <div class="card udemy-card h-100 border-0 shadow-sm p-2">
                        <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top rounded" style="height: 150px; object-fit: cover;">
                        <div class="card-body p-2">
                            <h6 class="fw-bold text-truncate mb-1">{{ $related->name }}</h6>
                            <p class="text-muted small mb-1">{{ $related->details->brand ?? 'إصدار مميز' }}</p>
                            <div class="fw-bold">{{ $related->price }} ج.م</div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-muted">لا توجد ساعات مقترحة حالياً في هذا القسم.</p>
        @endforelse
    </div>
</div>
@endsection