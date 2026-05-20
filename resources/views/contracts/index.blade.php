@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-3">Mis Contratos</h2>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Dueño</th>
                        <th>Cliente</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contracts as $contract)
                        <tr>
                            <td>{{ $contract->id }}</td>
                            <td>{{ $contract->product->title }}</td>
                            <td>{{ $contract->owner->name }}</td>
                            <td>{{ $contract->renter->name }}</td>
                            <td>{{ $contract->start_date }}</td>
                            <td>{{ $contract->end_date }}</td>
                            <td>${{ $contract->total_price }}</td>
                            <td>
                                <a href="{{ route('contracts.show', $contract->id) }}" class="btn btn-sm btn-primary">
                                    Ver contrato
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay contratos aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
