@extends('layouts.bootstrap')

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
                        <th>Acción</th>
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
                                @if($rental->status === 'active')
                                    <span class="badge bg-success">Activo</span>
                                @elseif($rental->status === 'canceled')
                                    <span class="badge bg-danger">Cancelado</span>
                                @else
                                    <span class="badge bg-secondary">{{ $rental->status }}</span>
                                @endif
                            </td>

                            <td>
                                @if($rental->status === 'active')
                                    <form action="{{ route('rentals.cancel', $rental->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-danger">Cancelar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No tienes alquileres aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
