{{-- resources/views/notifications/index.blade.php --}}

@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>All User Registrations</h2>

    <!-- Button to mark all notifications as read -->
    <form action="{{ route('notifications.markAsRead') }}" method="GET">
        <button type="submit" class="btn btn-primary mb-3">Mark All as Read</button>
    </form>

    <!-- List all registration notifications -->
    <ul class="list-group">
        @foreach ($notifications as $notification)
            <li class="list-group-item {{ $notification->read_at ? '' : 'bg-light' }}">
                @php
                    $data = json_decode($notification->data, true); // Decode JSON data to array
                @endphp

                @if(is_array($data))
                    {{ $data['message'] ?? 'No message available' }} - {{ $data['user_name'] ?? 'Unknown user' }}
                    <small class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                @else
                    <p>Notification data is invalid.</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
