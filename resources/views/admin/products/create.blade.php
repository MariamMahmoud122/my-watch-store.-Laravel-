@extends('layouts.admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* ... نفس الاستايلات اللي بعتيها ... */
    .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(10px); border-radius: 20px; padding: 40px; border: 1px solid rgba(255, 255, 255, 0.2); }
    .btn-gradient { background: linear-gradient(45deg, #a435f0, #8710d8); color: white; border: none; transition: 0.3s; border-radius: 50px; }
    .btn-gradient:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(164, 53, 240, 0.3); color: white; }
    .form-control, .form-select { border-radius: 10px; border: 1px solid #d1d7dc; padding: 12px; }
</style>

<div class="container pb-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <div class="py-4">
                <i class="fas fa-clock fa-3x mb-3" style="color: #7f5e95;"></i>
                <h1 class="fw-bold" style="color: #1c1d1f;">Add New Product</h1>
                <p class="text-muted">Fill in the details below to publish the watch in the shop</p>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger border-0 shadow-sm">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="glass-card shadow-lg">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4">
                <div class="col-md-6 border-end pe-md-4">
                    <h5 class="section-title text-primary">
                        <i class="fas fa-info-circle me-2"></i> Main Information
                    </h5>
                    
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-tag me-2 text-primary"></i>Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="e.g. Rolex Submariner" required value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-align-left me-2 text-primary"></i>Description</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Tell customers about this watch..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-dollar-sign me-2 text-success"></i>Price (EGP)</label>
                            {{-- حماية السعر: min="0" لمنع السوالب --}}
                            <input type="number" name="price" min="0" step="0.01" class="form-control" placeholder="0.00" required value="{{ old('price') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-list me-2 text-warning"></i>Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Choose category</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-camera me-2 text-danger"></i>Product Photo</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 ps-md-4">
                    <h5 class="section-title text-warning">
                        <i class="fas fa-star me-2"></i> Inner Details
                    </h5>
                    
                    {{-- تحويل البراند لـ Select --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-building me-2 text-secondary"></i>Brand</label>
                        <select name="brand" class="form-select">
                            <option value="">Select Brand</option>
                            <option value="Rolex">Rolex</option>
                            <option value="Casio">Casio</option>
                            <option value="Apple">Apple</option>
                            <option value="Samsung">Samsung</option>
                            <option value="Tissot">Tissot</option>
                            <option value="Special Edition">Special Edition</option>
                        </select>
                    </div>

                    {{-- تحويل الخامات لـ Select --}}
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-gem me-2 text-info"></i>Material</label>
                        <select name="material" class="form-select">
                            <option value="">Select Material</option>
                            <option value="Stainless Steel">Stainless Steel</option>
                            <option value="Leather">Leather</option>
                            <option value="Rubber">Rubber</option>
                            <option value="Gold Plated">Gold Plated</option>
                            <option value="Titanium">Titanium</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-magic me-2 text-purple"></i>Features</label>
                        <textarea name="features" class="form-control" rows="4" placeholder="Waterproof, Sapphire glass, Bluetooth, etc...">{{ old('features') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-gradient btn-lg px-5 py-3 shadow">
                    <i class="fas fa-cloud-upload-alt me-2"></i> Publish to the Shop
                </button>
            </div>
        </form>
    </div>
</div>
@endsection