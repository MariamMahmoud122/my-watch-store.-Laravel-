@extends('layouts.app')

@section('content')
@php
    
    $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
    $total = 0; 
@endphp

<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-4">
            <h1 class="fw-bold h2">Shopping Cart</h1>
            <p class="text-muted">You have {{ count($cart) }} items in your cart</p>
        </div>

        @if(count($cart) > 0)
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4 border-0">Product</th>
                                        <th class="border-0">Price</th>
                                        <th class="border-0 text-center">Quantity</th>
                                        <th class="border-0">Subtotal</th>
                                        <th class="border-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $details)
                                        @php 
                                        
                                            $rowSubtotal = $details['price'] * $details['quantity'];
                                            $total += $rowSubtotal; 
                                        @endphp
                                        <tr>
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $details['image']) }}" 
                                                         class="rounded shadow-sm me-3" 
                                                         style="width: 70px; height: 70px; object-fit: cover;">
                                                    <div>
                                                        <h6 class="fw-bold mb-1 text-dark">{{ $details['name'] }}</h6>
                                                        <span class="text-muted small">Premium Quality</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-bold">{{ number_format($details['price'], 2) }} EGP</td>
                                            
                                            <td class="text-center">
                                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center justify-content-center quantity-form">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" 
                                                           min="1" class="form-control form-control-sm text-center shadow-sm quantity-input" 
                                                           style="width: 65px; border-radius: 5px;">
                                                </form>
                                            </td>

                                            <td class="fw-bold text-primary">
                                                {{ number_format($rowSubtotal, 2) }} EGP
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-outline-danger border-0">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('shop.index') }}" class="text-decoration-none text-primary fw-bold">
                        <i class="fas fa-arrow-left me-1"></i> Continue Shopping
                    </a>
                </div>
            </div>

            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm rounded-0 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold mb-4">Order Summary</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>{{ number_format($total, 2) }} EGP</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 pb-3 border-bottom">
                        <span class="text-muted">Shipping</span>
                        <span class="text-success small fw-bold">Free Shipping</span>
                    </div>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total Amount</span>
                        <span class="fw-bold fs-4 text-dark">{{ number_format($total, 2) }} EGP</span>
                    </div>

                    <a href="{{ route('cart.checkout') }}" class="btn btn-dark w-100 py-3 fs-5 mb-3 text-center d-block rounded-0 shadow">
                        Proceed to Checkout
                    </a>
                    
                    <p class="text-center text-muted small">
                        <i class="fas fa-lock me-1"></i> 100% Secure Payment
                    </p>
                </div>
            </div>
        @else
            <div class="col-12 text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-shopping-basket fa-5x text-light-emphasis opacity-25"></i>
                </div>
                <h3 class="fw-bold">Your cart is currently empty</h3>
                <p class="text-muted mb-4">You haven't added any watches to your cart yet.</p>
                <a href="{{ route('shop.index') }}" class="btn btn-dark px-5 py-3 rounded-pill shadow-sm">
                    Browse Shop Now
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            this.closest('.quantity-form').submit();
        });
    });
</script>
@endsection