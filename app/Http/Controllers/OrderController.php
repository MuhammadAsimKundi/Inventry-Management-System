<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Notifications\OrderNotification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'product'])->get();
        return view('orders.all_order', compact('orders'));
    }

    public function add()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.add_order', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        // Calculate total price
        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->retail_price * $request->quantity;

        // Create the order
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        // Send notification to user associated with the customer, if exists
        $customer = Customer::findOrFail($request->customer_id);
        if ($customer->user) { // Ensure there is a user associated with the customer
            $customer->user->notify(new OrderNotification($order));
        }

        return redirect()->route('orders.all_order')->with('success', 'Order added successfully and notification sent!');
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.edit_order', compact('order', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'total_price' => 'required|numeric',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return redirect()->route('orders.all_order')->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.all_order')->with('success', 'Order deleted successfully!');
    }
}
