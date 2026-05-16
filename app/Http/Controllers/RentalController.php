<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payment;



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

    // Validar choque de fechas (overlap)
    $existsRental = Rental::where('product_id', $product->id)
        ->where('status', 'active')
        ->where(function ($query) use ($request) {
            $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                  ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('start_date', '<=', $request->start_date)
                        ->where('end_date', '>=', $request->end_date);
                  });
        })
        ->exists();

    if ($existsRental) {
        return back()->with('error', 'Este producto ya está alquilado en esas fechas.');
    }

    $start = \Carbon\Carbon::parse($request->start_date);
    $end = \Carbon\Carbon::parse($request->end_date);

    $days = $start->diffInDays($end) + 1;
    $total = $days * $product->price_per_day;

    $rental = Rental::create([
    'user_id' => auth()->id(),
    'product_id' => $product->id,
    'start_date' => $request->start_date,
    'end_date' => $request->end_date,
    'total_price' => $total,
    'status' => 'active'
]);

Payment::create([
    'rental_id' => $rental->id,
    'payer_id' => auth()->id(),
    'owner_id' => $product->user_id,
    'amount' => $total,
    'method' => 'cash',
    'status' => 'paid'
]);

return redirect()->route('payments.my')->with('success', 'Alquiler realizado y pago registrado.');
}

    public function myRentals()
{
    $rentals = Rental::where('user_id', auth()->id())
        ->with('product')
        ->latest()
        ->get();

    return view('rentals.my', compact('rentals'));
}

public function cancel(Rental $rental)
{
    if ($rental->user_id !== auth()->id()) {
        abort(403);
    }

    $rental->status = 'canceled';
    $rental->save();

    return redirect()->route('rentals.my')->with('success', 'Alquiler cancelado.');
}

public function received()
{
    $rentals = Rental::whereHas('product', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with(['product', 'user'])
        ->latest()
        ->get();

    return view('rentals.received', compact('rentals'));
}

public function finish(Rental $rental)
{
    if ($rental->product->user_id !== auth()->id()) {
        abort(403);
    }

    $rental->status = 'finished';
    $rental->save();

    return back()->with('success', 'Alquiler marcado como finalizado.');
}

public function cancelByOwner(Rental $rental)
{
    if ($rental->product->user_id !== auth()->id()) {
        abort(403);
    }

    $rental->status = 'canceled';
    $rental->save();

    return back()->with('success', 'Alquiler cancelado.');
}


}
