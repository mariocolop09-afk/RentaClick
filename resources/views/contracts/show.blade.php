@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Contrato Digital #{{ $contract->id }}</h2>
        <button class="btn btn-dark" onclick="window.print()">Imprimir</button>
    </div>

    <div class="card shadow-sm p-4">

        <h4 class="fw-bold mb-3 text-center">CONTRATO DE ALQUILER</h4>

        <p><strong>Fecha:</strong> {{ $contract->created_at->format('Y-m-d') }}</p>

        <hr>

        <h5 class="fw-bold">1. Partes</h5>
        <p>
            <strong>Arrendador (Dueño):</strong> {{ $contract->owner->name }} <br>
            <strong>Arrendatario (Cliente):</strong> {{ $contract->renter->name }}
        </p>

        <hr>

        <h5 class="fw-bold">2. Producto alquilado</h5>
        <p>
            <strong>Producto:</strong> {{ $contract->product->title }} <br>
            <strong>Descripción:</strong> {{ $contract->product->description }}
        </p>

        <hr>

        <h5 class="fw-bold">3. Fechas del alquiler</h5>
        <p>
            <strong>Inicio:</strong> {{ $contract->start_date }} <br>
            <strong>Fin:</strong> {{ $contract->end_date }}
        </p>

        <hr>

        <h5 class="fw-bold">4. Precio</h5>
        <p>
            <strong>Precio por día:</strong> Q{{ $contract->price_per_day }} <br>
            <strong>Total:</strong> Q{{ $contract->total_price }}
        </p>

        <hr>

        <h5 class="fw-bold">5. Términos y condiciones</h5>

        <p style="white-space: pre-line;">
            {{ $contract->terms }}
        </p>

        <hr>

        <h5 class="fw-bold">6. Aceptación</h5>
        <p>
            Ambas partes aceptan el presente contrato digital generado por la plataforma.
        </p>

        <br><br>

        <div class="row text-center">
            <div class="col-md-6">
                <p>__________________________</p>
                <p><strong>{{ $contract->owner->name }}</strong></p>
                <p>Firma Arrendador</p>
            </div>

            <div class="col-md-6">
                <p>__________________________</p>
                <p><strong>{{ $contract->renter->name }}</strong></p>
                <p>Firma Arrendatario</p>
            </div>
        </div>

    </div>

</div>
@endsection
