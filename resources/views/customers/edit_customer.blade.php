<!-- resources/views/customer/edit_customer.blade.php -->

@extends('layouts.layout')

@section('content')
<div class="container">
    <h3>Edit Customer</h3>
    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="male" {{ old('gender', $customer->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $customer->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $customer->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" required>{{ old('address', $customer->address) }}</textarea>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $customer->state) }}" required>
            @error('state')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $customer->country) }}" required>
            @error('country')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $customer->dob) }}" required>
            @error('dob')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
