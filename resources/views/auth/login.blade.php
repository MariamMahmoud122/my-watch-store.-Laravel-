@extends('layouts.app')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-center mb-4">تسجيل الدخول</h3>
                    
                    @if($errors->any())
                        <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                    @endif


                    @if(session('url.intended'))
    <div class="alert alert-warning border-0 shadow-sm mb-4" style="border-radius: 10px;">
        <i class="fas fa-exclamation-circle me-2"></i>
        عفواً! يجب عليك تسجيل الدخول أولاً لإتمام عملية الشراء.
    </div>
@endif
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" placeholder="example@mail.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 fw-bold py-2" style="border-radius: 10px;">دخول</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-bold">إنشاء حساب جديد</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection