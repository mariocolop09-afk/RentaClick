<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
   public function index(Request $request)
{
    $query = Product::query()
    ->where('is_available', true)
    ->where('is_approved', true)
    ->withAvg('reviews', 'rating');

    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->latest()->paginate(9);

    $categories = Category::all();

    return view('products.index', compact('products', 'categories'));
}
   public function create()
        {
            $categories = Category::all();
            return view('products.create', compact('categories'));
        }

    public function store(Request $request)
        {
            $request->validate([
                'title' => 'required|string|max:200',
                'description' => 'required|string',
                'price_per_day' => 'required|numeric|min:1',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'category_id' => 'nullable|exists:categories,id',
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
    'category_id' => $request->category_id,
    'image' => $imagePath,
    'is_available' => true,
    'is_approved' => false
]);

            return redirect()->route('products.my')->with('success', 'Producto publicado correctamente.');
        }
    public function show(Product $product)
    {
       $product->load(['user', 'reviews.user']);

    return view('products.show', compact('product'));
    }

   public function edit(Product $product)
{
    if ($product->user_id !== auth()->id()) {
        abort(403);
    }

    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
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
                'category_id' => 'nullable|exists:categories,id',
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
            $product->category_id = $request->category_id;
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
