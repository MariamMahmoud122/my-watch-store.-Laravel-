@extends('layouts.admin')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-black">إدارة المخزن</h2>
    <div>
      
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-dark px-4 py-2 me-2">
            <i class="fas fa-shopping-cart me-1"></i> Orders
        </a>
        
        <a href="{{ route('products.create') }}" class="btn btn-primary px-4 py-2">
            <i class="fas fa-plus me-1"></i> add new Product
        </a>
    </div>
</div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-info text-white border-0 shadow-sm p-3">
                <h5>إجمالي الساعات</h5>
                <h2 class="fw-bold">{{ $products->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white border-0 shadow-sm p-3">
                <h5>إجمالي القيمة</h5>
                <h2 class="fw-bold">{{ $products->sum('price') }} ج.م</h2>
            </div>
        </div>
    </div>

    <div class="glass-card shadow-lg p-0 overflow-hidden">
        <table class="table table-hover text-white mb-0">
            <thead class="bg-dark text-white">
                <tr>
                    <th>image</th>
                    <th>name</th>
                    <th>brand</th>
                    <th>price</th>
                    <th>control</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="align-middle">
                    <td><img src="{{ asset('storage/'.$product->image) }}" width="60" class="rounded shadow-sm"></td>
                    <td class="fw-bold">{{ $product->name }}</td>
                    <td>{{ $product->details->brand ?? '---' }}</td>
                    <td>{{ $product->price }} E.G</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('هل أنتِ متأكدة من حذف هذه الساعة؟')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection