<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; 
use App\Models\OrderItem; 
use Illuminate\Support\Facades\Cookie; 

class CartController extends Controller
{
   
    public function index() 
    {
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
        return view('shop.cart', compact('cart'));
    }

  
    public function add($id) 
    {
        $product = Product::findOrFail($id);
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        Cookie::queue('shopping_cart', json_encode($cart), 10080);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    
    public function remove($id) 
    {
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
        if(isset($cart[$id])) {
            unset($cart[$id]);
            Cookie::queue('shopping_cart', json_encode($cart), 10080);
        }
        return redirect()->back()->with('success', 'تم حذف المنتج من السلة');
    }

  
    public function update(Request $request, $id)
    {
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];

        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Cookie::queue('shopping_cart', json_encode($cart), 10080);
            return redirect()->back()->with('success', 'Cart updated successfully!');
        }
    }


    public function checkout()
    {
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سلتك فارغة، ضيفي منتجات الأول!');
        }

        return view('shop.checkout'); 
    }

  
    public function confirmOrder(Request $request) 
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'         => 'required',
            'address'       => 'required',
        ]);

       
        $cart = json_decode(Cookie::get('shopping_cart'), true) ?: [];
        
        if(empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'سلتك فارغة!');
        }

       
        $total = 0;
        foreach($cart as $item) { 
            $total += $item['price'] * $item['quantity']; 
        }

      
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'total_price'   => $total,
            'status'        => 'pending',
        ]);


        foreach($cart as $productId => $details) {
          
            OrderItem::create([ 
                'order_id'   => $order->id,
                'product_id' => $productId,
                'quantity'   => $details['quantity'],
                'price'      => $details['price'],
            ]);
        }

  
Cookie::queue(Cookie::forget('shopping_cart'));

return redirect()->route('shop.index')->with('success', 'تم تسجيل طلبك بنجاح');
    }
}