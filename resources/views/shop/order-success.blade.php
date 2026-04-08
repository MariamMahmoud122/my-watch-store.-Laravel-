@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="card border-0 shadow p-5">
        <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
        <h1 class="fw-bold">Order Placed Successfully!</h1>
        <p class="text-muted fs-5">Thank you, {{ $order->customer_name }}. Your order #{{ $order->id }} is being processed.</p>
        <hr class="my-4">
        <p>Total Amount: <strong>{{ $order->total_price }} EGP</strong></p>
        <p>Payment Method: <strong>Cash on Delivery</strong></p>
        <a href="{{ route('shop.index') }}" class="btn btn-dark btn-lg px-5 mt-3">Back to Store</a>
    </div>
</div>
@endsection