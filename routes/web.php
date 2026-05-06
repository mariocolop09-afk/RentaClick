<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

Route::get('/products', function () {
    return view('products.index', ['products' => collect()]);
})->name('products.index');

Route::get('/products/create', function () {
    return view('products.create');
})->name('products.create');

Route::get('/products/my', function () {
    return view('products.my', ['products' => collect()]);
})->name('products.my');

Route::get('/products/{id}', function ($id) {
    return view('products.show', ['product' => (object)[
        'id' => $id,
        'title' => 'Producto Demo',
        'description' => 'Descripción demo',
        'price_per_day' => 10,
        'image_url' => null,
        'user' => (object)['name' => 'Usuario Demo']
    ]]);
})->name('products.show');

Route::get('/products/{id}/edit', function ($id) {
    return view('products.edit', ['product' => (object)[
        'id' => $id,
        'title' => 'Producto Demo',
        'description' => 'Descripción demo',
        'price_per_day' => 10,
        'image_url' => null
    ]]);
})->name('products.edit');

Route::get('/profile', function () {
    return view('profile.index');
})->name('profile.index');

Route::get('/rentals/my', function () {
    return view('rentals.my', ['rentals' => collect()]);
})->name('rentals.my');

Route::post('/logout', function () {
    return redirect()->route('home');
})->name('logout');

Route::post('/products', function () {})->name('products.store');
Route::put('/products/{id}', function () {})->name('products.update');
Route::delete('/products/{id}', function () {})->name('products.destroy');
Route::post('/rentals/{id}', function () {})->name('rentals.store');
Route::put('/profile', function () {})->name('profile.update');
