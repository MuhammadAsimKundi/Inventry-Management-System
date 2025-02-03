<!-- resources/views/product/add_product.blade.php -->

@extends('layouts.layout')
@section('content')

<div class="container">
    <h2>Add Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="stock_price">Stock Price:</label>
            <input type="number" class="form-control" id="stock_price" name="stock_price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="retail_price">Retail Price:</label>
            <input type="number" class="form-control" id="retail_price" name="retail_price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
