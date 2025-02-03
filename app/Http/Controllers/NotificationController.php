<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function index()
    {
        // Get all registration notifications
        $notifications = \DB::table('notifications')
            ->where('type', 'App\Notifications\UserNotification') // Assuming you're using UserNotification for registrations
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead()
    {
        // Mark all notifications as read
        \DB::table('notifications')->whereNull('read_at')->update(['read_at' => now()]);
        return redirect()->route('notifications');
    }
}
