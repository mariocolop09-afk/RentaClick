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
                            @if($payment->method === 'card')
                            💳 {{ $payment->card_brand }} ****{{ $payment->card_last4 }}
                            @else
                            💵 EFECTIVO
                            @endif

                            <p class="mb-1">
                            <strong>Depósito:</strong>
                            ${{ $payment->deposit_amount }}
                            </p>

                            <p>
                            <strong>Estado depósito:</strong>

                            @if($payment->deposit_status == 'authorized')
                            <span class="badge bg-warning text-dark">Retenido</span>

                            @elseif($payment->deposit_status == 'released')
                            <span class="badge bg-success">Liberado</span>

                            @elseif($payment->deposit_status == 'retained')
                            <span class="badge bg-danger">Retenido por daños</span>
                            @endif
                            </p>

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
