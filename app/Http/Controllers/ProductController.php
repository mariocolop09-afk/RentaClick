<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
            }

            Product::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'description' => $request->description,
                'price_per_day' => $request->price_per_day,
                'image' => $imagePath,
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
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($request->hasFile('image')) {

                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $product->image = $request->file('image')->store('products', 'public');
            }

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price_per_day = $request->price_per_day;
            $product->save();

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
