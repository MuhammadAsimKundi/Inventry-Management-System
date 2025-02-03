@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>All Orders</h3>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('orders.add') }}" class="btn btn-primary my-2">Add Order</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->product->name }}</td> <!-- Fixed to get product name -->
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->total_price }}</td>
                    <td>
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
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
