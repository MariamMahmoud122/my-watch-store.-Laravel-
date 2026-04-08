<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    
    public function index() {
        $products = Product::latest()->get(); 
        return view('admin.products.index', compact('products'));
    }

    
    public function create()
    {
        return view('admin.products.create');
    }

    
    public function shopIndex(Request $request)
    {
        $query = Product::with('details')->latest();

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();
        return view('shop.index', compact('products'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'price'       => 'required|numeric',
            'category_id' => 'required',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'category_id' => $request->category_id,
            'image'       => $imagePath,
        ]);

        $product->details()->create([
            'brand'    => $request->brand,
            'material' => $request->material,
            'features' => $request->features,
        ]);

        
        return redirect()->route('products.index')->with('success', 'done successfully');
    }


    public function show($id)
    {
        $product = Product::with('details')->findOrFail($id);

        $relatedProducts = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $id)
                                    ->take(4)
                                    ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if($product->image && file_exists(public_path('storage/'.$product->image))){
            unlink(public_path('storage/'.$product->image));
        }
        
        $product->delete();
        return redirect()->back()->with('success', 'تم حذف الساعة بنجاح من المخزن! 🗑️');
    }


    public function edit($id)
    {
        $product = Product::with('details')->findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

  
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if($product->image && file_exists(public_path('storage/'.$product->image))){
                unlink(public_path('storage/'.$product->image));
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        
        $product->details()->update([
            'brand'    => $request->brand,
            'material' => $request->material,
            'features' => $request->features,
        ]);

        return redirect()->route('products.index')->with('success', 'تم تحديث بيانات الساعة بنجاح يا مريم! ');
    }
}