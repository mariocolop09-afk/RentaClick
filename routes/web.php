<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
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

    // Favorites
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{product}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favorites/{product}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readall');

    // Dashboard
    Route::get('/rentals/received', [RentalController::class, 'received'])->name('rentals.received');

    Route::patch('/rentals/{rental}/finish', [RentalController::class, 'finish'])->name('rentals.finish');

    Route::patch('/rentals/{rental}/cancel-owner', [RentalController::class, 'cancelByOwner'])->name('rentals.cancel.owner');

    // Report routes
    Route::post('/reports/{product}', [ReportController::class, 'store'])->name('reports.store');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversation}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{conversation}/send', [ChatController::class, 'send'])->name('chat.send');

    Route::post('/chat/start/{user}', [ChatController::class, 'start'])->name('chat.start');

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



    Route::middleware('admin')->group(function () {

    Route::get('/admin/reports', [ReportController::class, 'adminIndex'])->name('admin.reports');
    Route::patch('/admin/reports/{report}/resolve', [ReportController::class, 'resolve'])->name('admin.reports.resolve');

    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::patch('/admin/products/{product}/approve', [AdminController::class, 'approve'])->name('admin.products.approve');

    Route::patch('/admin/products/{product}/reject', [AdminController::class, 'reject'])->name('admin.products.reject');

    Route::patch('/admin/products/{product}/toggle', [AdminController::class, 'toggleAvailability'])->name('admin.products.toggle');


});

Route::get('/payments/my', [PaymentController::class, 'myPayments'])->name('payments.my');
Route::get('/payments/earnings', [PaymentController::class, 'myEarnings'])->name('payments.earnings');
});


// Product show (siempre al final)
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

require __DIR__.'/auth.php';
