<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function notifyLowStock()
    {
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        foreach ($lowStockProducts as $product) {
            // Assuming you are notifying the admin (or authenticated user)
            auth()->user()->notify(new LowStockNotification($product));
        }

        return redirect()->back()->with('success', 'Low stock notifications sent!');
    }
    public function index()
    {
        $products = Product::all();
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        return view('products.all_product', compact('products', 'lowStockProducts'));
    }

    public function add()
    {
        return view('products.add_product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imagePath,
            'stock_price' => $request->stock_price,
            'retail_price' => $request->retail_price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('products.all_product')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update($request->except('image'));

        return redirect()->route('products.all_product')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.all_product')->with('success', 'Product deleted successfully!');
    }
}
