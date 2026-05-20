<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Notification;
use App\Models\Contract;


class RentalController extends Controller
{
    public function store(Request $request, Product $product)
{
    $request->validate([
    'start_date' => 'required|date',
    'end_date' => 'required|date|after:start_date',

    'payment_method' => 'required|in:cash,card',

    'card_name' => 'required_if:payment_method,card',
    'card_number' => 'required_if:payment_method,card',
    'card_expiry' => 'required_if:payment_method,card',
    'card_cvv' => 'required_if:payment_method,card',
    ]);

    if (!$product->is_available) {
        return back()->with('error', 'Este producto no está disponible.');
    }

    if ($product->user_id === auth()->id()) {
        return back()->with('error', 'No puedes alquilar tu propio producto.');
    }

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

    $cardBrand = null;
    $cardLast4 = null;

    if ($request->payment_method === 'card') {

    $number = preg_replace('/\s+/', '', $request->card_number);

    $cardLast4 = substr($number, -4);

    if (str_starts_with($number, '4')) {
        $cardBrand = 'Visa';
    } elseif (str_starts_with($number, '5')) {
        $cardBrand = 'MasterCard';
    } else {
        $cardBrand = 'Tarjeta';
    }
    }

    Payment::create([
        'rental_id' => $rental->id,
        'payer_id' => auth()->id(),
        'owner_id' => $product->user_id,
        'amount' => $total,
        'method' => $request->payment_method,
        'card_name' => $request->payment_method === 'card'
        ? $request->card_name
        : null,

        'card_last4' => $cardLast4,

        'card_brand' => $cardBrand,
        'status' => 'paid'
    ]);

    Contract::create([
    'rental_id' => $rental->id,
    'owner_id' => $product->user_id,
    'renter_id' => auth()->id(),
    'product_id' => $product->id,

    'start_date' => $request->start_date,
    'end_date' => $request->end_date,

    'price_per_day' => $product->price_per_day,
    'total_price' => $total,

    'terms' => "1. El arrendatario se compromete a cuidar el producto.\n
2. Si el producto se entrega dañado, el arrendatario será responsable.\n
3. El producto debe devolverse en la fecha acordada.\n
4. El pago se realiza según lo indicado en la plataforma.\n
5. Ambas partes aceptan estos términos.",

    'status' => 'active'
]);

    return redirect()->route('contracts.index')->with('success', 'Alquiler realizado y contrato generado.');

    Notification::create([
    'user_id' => $product->user_id,
    'title' => 'Nuevo alquiler',
    'message' => 'Alguien alquiló tu producto: ' . $product->title,
    'type' => 'rental',
    'is_read' => false
]);

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
