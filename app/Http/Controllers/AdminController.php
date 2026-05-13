<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingProducts = Product::where('is_approved', false)->with('user')->latest()->get();
        $approvedProducts = Product::where('is_approved', true)->with('user')->latest()->get();
        $users = User::latest()->get();

        return view('admin.dashboard', compact('pendingProducts', 'approvedProducts', 'users'));
    }

    public function approve(Product $product)
    {
        $product->is_approved = true;
        $product->save();

        return back()->with('success', 'Producto aprobado.');
    }

    public function reject(Product $product)
    {
        $product->is_approved = false;
        $product->save();

        return back()->with('success', 'Producto rechazado.');
    }

    public function toggleAvailability(Product $product)
    {
        $product->is_available = !$product->is_available;
        $product->save();

        return back()->with('success', 'Disponibilidad actualizada.');
    }
}