@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-3">Mis Pagos</h2>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Monto</th>
                        <th>Método</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->rental->product->title ?? 'Producto' }}</td>
                            <td>Q{{ $payment->amount }}</td>
                            <td>{{ strtoupper($payment->method) }}</td>
                            <td>
                                @if($payment->status == 'paid')
                                    <span class="badge bg-success">Pagado</span>
                                @else
                                    <span class="badge bg-secondary">{{ $payment->status }}</span>
                                @endif
                            </td>
                            <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No tienes pagos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
