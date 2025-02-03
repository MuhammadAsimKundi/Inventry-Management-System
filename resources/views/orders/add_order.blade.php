<!-- resources/views/order/add_order.blade.php -->

@extends('layouts.layout')
@section('content')

<div class="container">
    <h3>Add Order</h3>
    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="customer_id">Customer:</label>
            <select class="form-control" id="customer_id" name="customer_id" required>
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select class="form-control" id="product_id" name="product_id" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option> <!-- Assuming Product model has 'name' attribute -->
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="total_price">Total Price:</label>
            <input type="number" class="form-control" id="total_price" name="total_price" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
