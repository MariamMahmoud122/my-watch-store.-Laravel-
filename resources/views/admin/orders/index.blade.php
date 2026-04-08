@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-black"><i class="fas fa-shopping-bag me-2"></i> إدارة طلبات العملاء</h2>
  
        <a href="{{ route('products.index') }}" class="btn btn-outline-dark px-4 shadow-sm">
            <i class="fas fa-arrow-right me-1"></i> العودة للمخزن
        </a>
    </div>

  
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white border-0 shadow-sm p-3 text-center">
                <h6>إجمالي الطلبات</h6>
                <h2 class="fw-bold">{{ $orders->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark border-0 shadow-sm p-3 text-center">
                <h6>بانتظار المراجعة</h6>
                <h2 class="fw-bold">{{ $orders->where('status', 'pending')->count() }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white border-0 shadow-sm p-3 text-center">
                <h6>إجمالي المبيعات</h6>
                <h2 class="fw-bold">{{ number_format($orders->sum('total_price'), 2) }} ج.م</h2>
            </div>
        </div>
    </div>

    <div class="glass-card shadow-lg p-0 overflow-hidden" style="background: rgba(255,255,255,0.9); border-radius: 15px;">
        <table class="table table-hover mb-0">
            <thead class="bg-dark text-white text-center">
                <tr>
                    <th>رقم الطلب</th>
                    <th>العميل</th>
                    <th>الهاتف/العنوان</th>
                    <th>المنتجات</th>
                    <th>الإجمالي</th>
                    <th>الحالة</th>
                    <th>التحكم</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($orders as $order)
                <tr class="align-middle">
                    <td><span class="badge bg-secondary">#{{ $order->id }}</span></td>
                    <td class="fw-bold">{{ $order->customer_name }}</td>
                    <td class="small">{{ $order->phone }} <br> <span class="text-muted">{{ $order->address }}</span></td>
                    <td>
                        <ul class="list-unstyled mb-0 small text-start">
                            @foreach($order->items as $item)
                                <li>• {{ $item->product->name ?? 'منتج محذوف' }} ({{ $item->quantity }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-primary fw-bold">{{ number_format($order->total_price, 2) }} ج.م</td>
                    <td>
                        @if($order->status == 'pending')
                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                        @else
                            <span class="badge bg-success">تمت الموافقة</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                        
                            @if($order->status == 'pending')
                                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif

                       
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل إنت متأكدة من حذف هذا الأوردر نهائياً؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection