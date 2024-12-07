<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    //return 'Hello, World!';
//    return view('components');
//});

// routes/web.php



use App\Http\Controllers\ComponentController;

// Main page route
Route::get('/', [ComponentController::class, 'main'])->name('main.page1');

// Show components by type
Route::get('/components/{type}', [ComponentController::class, 'showByType'])->name('show.components');

// Add a component
Route::get('/add-component/{type}/{id}', [ComponentController::class, 'addComponent'])->name('add.component1');

// Reset selections
Route::get('/reset-selections', [ComponentController::class, 'resetSelections'])->name('reset.selections1');



use App\Http\Controllers\AdminController;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComponentsExport;

// Admin Login Page
Route::get('/admin/login', [AdminController::class, 'showLoginPage'])->name('admin.login');

// Admin Login Form Submission (authentication)
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Admin Dashboard (protected route, requires login)
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard')->middleware('auth');

// Admin Logout
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin Component Filtering by Type (CPU, RAM, SSD)
Route::get('/admin/dashboard/components', [AdminController::class, 'showComponents'])->name('admin.dashboard.components');

// Update Component Quantity
Route::post('/admin/dashboard/update/{id}', [AdminController::class, 'updateComponentQuantity'])->name('update.component.quantity');

// Delete Component
Route::delete('/admin/dashboard/delete/{id}', [AdminController::class, 'deleteComponent'])->name('delete.component');

// Add New Component
Route::post('/admin/dashboard/add', [AdminController::class, 'addComponent'])->name('add.component2');

// Admin Stock Summary Export (Excel or PDF)
Route::get('/admin/export/{type?}/{format?}', [AdminController::class, 'exportComponents'])
    ->name('export.components')
    ->where('format', 'excel|pdf');

Route::put('/admin/dashboard/update/{id}', [AdminController::class, 'updateComponent'])->name('update.component');



//ecommerce routes


use App\Http\Controllers\EcommerceController;

Route::get('/main', function () {
    return view('ecommerce.ecommerce');
})->name('main.page');

Route::get('/category/{category}', [EcommerceController::class, 'showCategory'])->name('ecommerce.category');


Route::get('/cart', [EcommerceController::class, 'showCart'])->name('cart.page');
Route::get('/cart/add/{type}/{id}', [EcommerceController::class, 'addToCart'])->name('add.component');
Route::get('/cart/update/{id}/{quantity}', [EcommerceController::class, 'updateQuantity'])->name('cart.update');
Route::get('/reset', [EcommerceController::class, 'resetCart'])->name('reset.selections');




Route::get('/login', [EcommerceController::class, 'login'])->name('ecommerce.login');
Route::post('/authenticate', [EcommerceController::class, 'loginSubmit'])->name('ecommerce.login.auth');
Route::get('/dashboard', [EcommerceController::class, 'dashboard'])->name('ecommerce.dashboard');

Route::get('/register', [EcommerceController::class, 'register'])->name('ecommerce.register');

Route::post('/register/store', [EcommerceController::class, 'registerSubmit'])->name('ecommerce.register.submit');

Route::get('/dashboard/logout', [EcommerceController::class,  'logout'])->name('ecommerce.logout');


Route::post('/place-order', [EcommerceController::class, 'placeOrder'])->name('place.order');



use App\Http\Controllers\PaymentController;

// Route to show the payment page with order_id as a parameter
Route::get('/payment/{order_id}', [PaymentController::class, 'showPaymentPage'])->name('payment.show');

// Route to handle the payment form submission (POST)
Route::post('/payment/{order_id}', [PaymentController::class, 'processPayment'])->name('payment.process');












