@extends('layouts.app') {{-- أو الـ layout اللي بتستخدميه --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-center mb-4">إنشاء حساب جديد</h3>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">الاسم بالكامل</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="أدخل اسمك">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="example@mail.com">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter Your Password">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Enter Your Password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2" style="border-radius: 10px;">انضم الآن</button>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-muted small">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">تسجيل دخول</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection