@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-3">Mis alquileres</h2>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Total</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rentals as $rental)
                        <tr>
                            <td>{{ $rental->product->title ?? 'Producto' }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>${{ $rental->total_price }}</td>
                            <td>
                                <span class="badge bg-success">{{ $rental->status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No tienes alquileres aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
