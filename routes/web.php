<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\SellerAuthController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CatalogController;
// Home Route - Landing page katalog
Route::get('/', [CatalogController::class, 'index'])->name('home');
// Katalog publik
Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{id}', [CatalogController::class, 'show'])->name('catalog.show');
Route::post('/catalog/{id}/review', [\App\Http\Controllers\ReviewController::class, 'store'])->name('catalog.review.store');

// Seller Auth Routes (PUBLIC)
Route::prefix('seller')->group(function () {
    Route::get('/register', [SellerAuthController::class, 'showRegisterForm'])->name('seller.register');
    Route::post('/register', [SellerAuthController::class, 'register']);
    Route::get('/login', [SellerAuthController::class, 'showLoginForm'])->name('seller.login');
    Route::post('/login', [SellerAuthController::class, 'login']);
    Route::post('/logout', [SellerAuthController::class, 'logout'])->name('seller.logout');
});

// Seller Dashboard & Product Routes (PROTECTED)
Route::prefix('seller')->middleware(['auth:seller'])->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'dashboard'])->name('seller.dashboard');
    
    // Product Management Routes
    Route::get('/products', [ProductController::class, 'index'])->name('seller.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('seller.products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('seller.products.destroy');
    Route::post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('seller.products.toggle-status');
    
    // Seller Reports Index
    Route::get('reports', function() {
        return view('seller.reports.index');
    })->name('seller.reports.index');
    // Seller PDF Reports
    Route::get('report/stock', [App\Http\Controllers\SellerReportController::class, 'stockReport'])->name('seller.report.stock');
    Route::get('report/rating', [App\Http\Controllers\SellerReportController::class, 'ratingReport'])->name('seller.report.rating');
    Route::get('report/reorder', [App\Http\Controllers\SellerReportController::class, 'reorderReport'])->name('seller.report.reorder');
    

});

// Admin Routes - SEMUA MENGGUNAKAN AdminController
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Seller Verification Routes - menggunakan AdminController
    Route::get('/sellers/verification', [AdminController::class, 'pendingSellers'])->name('admin.seller.verification');
    Route::get('/sellers', [AdminController::class, 'allSellers'])->name('admin.sellers.all');
    Route::post('/sellers/{id}/approve', [AdminController::class, 'approveSeller'])->name('admin.sellers.approve');
    Route::post('/sellers/{id}/reject', [AdminController::class, 'rejectSeller'])->name('admin.sellers.reject');

    // Report PDF routes (platform reports)
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/reports/sellers/status.pdf', [ReportController::class, 'sellersByStatusPdf'])->name('admin.reports.sellers.status.pdf');
    Route::get('/reports/sellers/province.pdf', [ReportController::class, 'sellersByProvincePdf'])->name('admin.reports.sellers.province.pdf');
    Route::get('/reports/products/rating.pdf', [ReportController::class, 'productsByRatingPdf'])->name('admin.reports.products.rating.pdf');
});


