@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>Edit Order</h3>
    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $product->id == $order->product_id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="number" class="form-control" id="total_price" name="total_price" value="{{ $order->total_price }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
