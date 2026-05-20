<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::where('owner_id', auth()->id())
            ->orWhere('renter_id', auth()->id())
            ->with(['product', 'owner', 'renter'])
            ->latest()
            ->get();

        return view('contracts.index', compact('contracts'));
    }

    public function show(Contract $contract)
    {
        if ($contract->owner_id !== auth()->id() && $contract->renter_id !== auth()->id()) {
            abort(403);
        }

        $contract->load(['product', 'owner', 'renter']);

        return view('contracts.show', compact('contract'));
    }
}
