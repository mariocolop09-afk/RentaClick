@extends('layouts.app')

@section('content')
<div class="container">

    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Alquila lo que necesites</h1>
            <p class="col-md-8 fs-5">
                Encuentra productos en alquiler desde vehículos hasta herramientas, tecnología o cosas del hogar.
            </p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                Ver productos
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Publica tus productos</h5>
                    <p class="card-text">Gana dinero alquilando cosas que no uses diariamente.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Alquila rápido</h5>
                    <p class="card-text">Busca, reserva y alquila productos en minutos.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Seguro y confiable</h5>
                    <p class="card-text">Sistema de usuarios y gestión de alquileres controlado.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
