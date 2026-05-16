<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
class PaymentController extends Controller
{
     public function myPayments()
    {
        $payments = Payment::where('payer_id', auth()->id())
            ->with('rental.product')
            ->latest()
            ->get();

        return view('payments.my', compact('payments'));
    }

    public function myEarnings()
    {
        $payments = Payment::where('owner_id', auth()->id())
            ->with('rental.product', 'payer')
            ->latest()
            ->get();

        $total = $payments->sum('amount');

        return view('payments.earnings', compact('payments', 'total'));
    }
}
