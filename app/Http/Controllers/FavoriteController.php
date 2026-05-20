<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->with('product')
            ->latest()
            ->get();

        return view('favorites.index', compact('favorites'));
    }

    public function store(Product $product)
    {
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);

        return back()->with('success', 'Producto agregado a favoritos.');
    }

    public function destroy(Product $product)
    {
        Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Producto eliminado de favoritos.');
    }
}
