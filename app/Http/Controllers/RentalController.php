<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if (!$product->is_available) {
            return back()->with('error', 'Este producto no está disponible.');
        }

        if ($product->user_id === auth()->id()) {
            return back()->with('error', 'No puedes alquilar tu propio producto.');
        }

        $start = Carbon::parse($request->start_date);
        $end = Carbon::parse($request->end_date);

        $days = $start->diffInDays($end) + 1;

        $total = $days * $product->price_per_day;

        Rental::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_price' => $total,
            'status' => 'active'
        ]);

        return redirect()->route('rentals.my')->with('success', 'Alquiler realizado correctamente.');
    }

    public function myRentals()
    {
        $rentals = Rental::where('user_id', auth()->id())
            ->with('product')
            ->latest()
            ->get();

        return view('rentals.my', compact('rentals'));
    }
}
