@extends('layouts.layout')
@section('content')

<div class="container">
    <h2>All Products</h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Low Stock Alert --}}
    @if($lowStockProducts->count())
        <div class="alert alert-warning">
            <strong>Low Stock Alert:</strong>
            @foreach($lowStockProducts as $product)
                <p>{{ $product->name }} is running low on stock (Quantity: {{ $product->quantity }}).</p>
            @endforeach
        </div>
    @endif

    {{-- Add Product Button --}}
    <a href="{{ route('products.add') }}" class="btn btn-primary my-2">Add Product</a>

    {{-- Products Table --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Image</th>
                <th>Stock Price</th>
                <th>Retail Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="width: 50px; height: 50px;">
                    </td>
                    <td>{{ $product->stock_price }}</td>
                    <td>{{ $product->retail_price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
