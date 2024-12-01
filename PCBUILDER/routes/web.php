<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    //return 'Hello, World!';
//    return view('components');
//});

// routes/web.php



use App\Http\Controllers\ComponentController;

// Main page route
Route::get('/', [ComponentController::class, 'main'])->name('main.page');

// Show components by type
Route::get('/components/{type}', [ComponentController::class, 'showByType'])->name('show.components');

// Add a component
Route::get('/add-component/{type}/{id}', [ComponentController::class, 'addComponent'])->name('add.component1');

// Reset selections
Route::get('/reset-selections', [ComponentController::class, 'resetSelections'])->name('reset.selections');



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
Route::post('/admin/dashboard/add', [AdminController::class, 'addComponent'])->name('add.component');

// Admin Stock Summary Export (Excel or PDF)
Route::get('/admin/export/{type?}/{format?}', [AdminController::class, 'exportComponents'])
    ->name('export.components')
    ->where('format', 'excel|pdf');

Route::put('/admin/dashboard/update/{id}', [AdminController::class, 'updateComponent'])->name('update.component');







