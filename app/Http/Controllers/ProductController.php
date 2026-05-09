<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('is_available', true);

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(9);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:1',
            'image_url' => 'nullable|string'
        ]);

        Product::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'image_url' => $request->image_url,
            'is_available' => true
        ]);

        return redirect()->route('products.my')->with('success', 'Producto publicado correctamente.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:1',
            'image_url' => 'nullable|string'
        ]);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price_per_day' => $request->price_per_day,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('products.my')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.my')->with('success', 'Producto eliminado.');
    }

    public function myProducts()
    {
        $products = Product::where('user_id', auth()->id())->latest()->get();

        return view('products.my', compact('products'));
    }
}
