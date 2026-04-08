@extends('layouts.admin')

@section('content')
<div class="container pb-5">
    <div class="row mb-4 text-center text-white">
        <div class="py-4">
            <i class="fas fa-edit fa-3x mb-3 text-black opacity-75"></i>
            <h1 class="fw-bold text-black opacity-75">Edit Product: {{ $product->name }}</h1>
            <p class="text-black opacity-75">Update details and save to refresh the shop</p>
        </div>
    </div>

    <div class="glass-card shadow-lg p-4 bg-dark text-white rounded">
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <div class="row g-4">
                <div class="col-md-6 border-end border-white border-opacity-10 pe-md-4">
                    <h5 class="mb-4 text-info"><i class="fas fa-info-circle me-2"></i> Basic Information</h5>
                    
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="2" required>{{ $product->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (EGP)</label>
                            {{-- أضفنا min="0" و step="0.01" لمنع السوالب --}}
                            <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="0" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select">
                                <option value="1" {{ $product->category_id == 1 ? 'selected' : '' }}>Watches</option>
                                <option value="2" {{ $product->category_id == 2 ? 'selected' : '' }}>Electronics</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning small">Current Image:</label>
                        <img src="{{ asset('storage/'.$product->image) }}" width="80" class="d-block mb-2 rounded shadow">
                        <label class="form-label">Change Photo</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>

                <div class="col-md-6 ps-md-4">
                    <h5 class="mb-4 text-warning"><i class="fas fa-star me-2"></i> Inner Details</h5>
                    
                    {{-- تحويل البراند إلى Select --}}
                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <select name="brand" class="form-select">
                            <option value="Rolex" {{ ($product->details->brand ?? '') == 'Rolex' ? 'selected' : '' }}>Rolex</option>
                            <option value="Casio" {{ ($product->details->brand ?? '') == 'Casio' ? 'selected' : '' }}>Casio</option>
                            <option value="Apple" {{ ($product->details->brand ?? '') == 'Apple' ? 'selected' : '' }}>Apple</option>
                            <option value="Samsung" {{ ($product->details->brand ?? '') == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                            <option value="Special Edition" {{ ($product->details->brand ?? '') == 'Special Edition' ? 'selected' : '' }}>Special Edition</option>
                        </select>
                    </div>

                    {{-- تحويل المواد إلى Select --}}
                    <div class="mb-3">
                        <label class="form-label">Material</label>
                        <select name="material" class="form-select">
                            <option value="Stainless Steel" {{ ($product->details->material ?? '') == 'Stainless Steel' ? 'selected' : '' }}>Stainless Steel</option>
                            <option value="Leather" {{ ($product->details->material ?? '') == 'Leather' ? 'selected' : '' }}>Leather</option>
                            <option value="Rubber" {{ ($product->details->material ?? '') == 'Rubber' ? 'selected' : '' }}>Rubber</option>
                            <option value="Gold Plated" {{ ($product->details->material ?? '') == 'Gold Plated' ? 'selected' : '' }}>Gold Plated</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Features</label>
                        <textarea name="features" class="form-control" rows="4">{{ $product->details->features ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success btn-lg px-5 py-3 shadow">
                    <i class="fas fa-save me-2"></i> Update Product
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg px-4 ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection