<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'reason' => 'required|string|max:100',
            'description' => 'nullable|string|max:500'
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'reason' => $request->reason,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Reporte enviado correctamente.');
    }

    public function adminIndex()
    {
        $reports = Report::with(['user', 'product'])
            ->latest()
            ->get();

        return view('admin.reports', compact('reports'));
    }

    public function resolve(Report $report)
    {
        $report->status = 'resolved';
        $report->save();

        return back()->with('success', 'Reporte marcado como resuelto.');
    }
}
