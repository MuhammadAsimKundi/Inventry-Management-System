<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data for the dashboard
        $monthlyEarnings = Order::whereMonth('created_at', now()->month)->sum('total_price');
        $annualEarnings = Order::whereYear('created_at', now()->year)->sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = Customer::count();

        // Check if user is authenticated before accessing notifications
        $notifications = auth()->check() ? auth()->user()->unreadNotifications : collect();

        return view('welcome', compact('monthlyEarnings', 'annualEarnings', 'totalOrders', 'totalCustomers', 'notifications'));
    }
}
