<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');



Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index'); // List all customers
Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create'); // Show form to create a new customer
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store'); // Store a new customer
Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit'); // Show form to edit a customer
Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update'); // Update a customer
Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy'); // Delete a customer


// routes/web.php


Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('all_product');
    Route::get('/add', [ProductController::class, 'add'])->name('add');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('/notify-low-stock', [ProductController::class, 'notifyLowStock'])->name('notifyLowStock');
});


// routes/web.php


Route::prefix('orders')->name('orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('all_order');
    Route::get('/add', [OrderController::class, 'add'])->name('add');
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [OrderController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [OrderController::class, 'destroy'])->name('destroy');
});


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

Route::get('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);



// Route::get('/home', [HomeController::class, 'index'])->name('home');
