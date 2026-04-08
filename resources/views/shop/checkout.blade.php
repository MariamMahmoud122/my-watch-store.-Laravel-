@extends('layouts.app')

@section('content')
@php
    // 1. جلب بيانات السلة من الكوكيز
    $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
    $total = 0;
@endphp

<div class="container py-5">
    <div class="row justify-content-center">
        {{-- الجزء الخاص بملخص الطلب --}}
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">ملخص سريع</span>
                <span class="badge bg-secondary rounded-pill">{{ count($cart) }}</span>
            </h4>
            <ul class="list-group mb-3 shadow-sm">
                @forelse($cart as $details)
                    @php 
                        $itemTotal = $details['price'] * $details['quantity'];
                        $total += $itemTotal;
                    @endphp
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $details['name'] }}</h6>
                            <small class="text-muted">الكمية: {{ $details['quantity'] }}</small>
                        </div>
                        <span class="text-muted">{{ number_format($itemTotal, 2) }} ج.م</span>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">السلة فارغة</li>
                @endforelse
               
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <span class="fw-bold">الإجمالي الكلي</span>
                    <strong class="text-primary fs-5">
                        {{ number_format($total, 2) }} ج.م
                    </strong>
                </li>
            </ul>
        </div>

    
        <div class="col-md-8 order-md-1">
            <div class="card border-0 shadow-sm p-4">
                <h4 class="mb-4 fw-bold"><i class="fas fa-truck me-2 text-black"></i> بيانات الشحن والتوصيل</h4>
                
                <form action="{{ route('cart.confirm') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">الاسم بالكامل</label>
                            <input type="text" name="customer_name" class="form-control py-2" placeholder="اكتبي اسم العميل هنا" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">رقم الهاتف </label>
                            <input type="text" name="phone" class="form-control py-2" placeholder="01xxxxxxxxx" required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">العنوان بالتفصيل (المدينة - الشارع - رقم المنزل)</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="اكتبي العنوان بدقة عشان الساعة توصل صح" required></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="bg-light p-3 rounded mb-4">
                        <p class="small text-muted mb-0">
                            <i class="fas fa-info-circle me-1"></i> 
                            الدفع سيكون "نقداً عند الاستلام" (Cash on Delivery) حالياً.
                        </p>
                    </div>

                    @if(count($cart) > 0)
                        <button class="btn btn-dark w-100 py-3 fs-5 shadow-sm" type="submit">
                            تأكيد الطلب الآن <i class="fas fa-check-circle ms-2"></i>
                        </button>
                    @else
                        <button class="btn btn-secondary w-100 py-3 fs-5" disabled>
                            السلة فارغة لإتمام الطلب
                        </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection