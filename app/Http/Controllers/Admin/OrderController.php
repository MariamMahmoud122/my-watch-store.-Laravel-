<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order; 
class OrderController extends Controller
{
  
    public function index(Request $request)
{
 
    $query = Order::with('items.product')->latest();

  
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        
        $query->where(function($q) use ($search) {
            $q->where('customer_name', 'like', '%' . $search . '%') 
              ->orWhere('id', 'like', '%' . $search . '%')       
              ->orWhere('phone', 'like', '%' . $search . '%');    
        });
    }

    $orders = $query->get();
    
    return view('admin.orders.index', compact('orders'));
}
    


    public function approve($id)
    {
        $order = Order::findOrFail($id);
        
    
        $order->update(['status' => 'completed']);
        
        return redirect()->back()->with('success', 'تمت الموافقة على الطلب بنجاح  !');
    }
    public function destroy($id)
{
    $order = Order::findOrFail($id);
    
   
    $order->delete();
    
    return redirect()->back()->with('success', 'تم حذف الأوردر بنجاح ');
}
}