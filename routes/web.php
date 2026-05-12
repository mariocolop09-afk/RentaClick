<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Products public
Route::get('/products', [ProductController::class, 'index'])->name('products.index');


// Auth routes
Route::middleware('auth')->group(function () {

    // Profile (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Products CRUD
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/my', [ProductController::class, 'myProducts'])->name('products.my');

    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Rentals
    Route::post('/rentals/{product}', [RentalController::class, 'store'])->name('rentals.store');
    Route::get('/rentals/my', [RentalController::class, 'myRentals'])->name('rentals.my');

    Route::patch('/rentals/{rental}/cancel', [RentalController::class, 'cancel'])->name('rentals.cancel');

    Route::post('/reviews/{product}', [ReviewController::class, 'store'])->name('reviews.store');
});


// Product show (siempre al final)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';