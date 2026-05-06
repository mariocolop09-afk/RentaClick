@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <img src="{{ $product->image_url ?? 'https://via.placeholder.com/600x400' }}" class="card-img-top" style="height: 350px; object-fit: cover;">
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h2 class="fw-bold">{{ $product->title }}</h2>
                <p class="text-muted">{{ $product->description }}</p>

                <p class="fs-4 fw-bold text-success">${{ $product->price_per_day }} / día</p>

                <p><strong>Publicado por:</strong> {{ $product->user->name ?? 'Usuario' }}</p>

                @auth
                    <form action="{{ route('rentals.store', $product->id) }}" method="POST" class="mt-4">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Fecha inicio</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Fecha fin</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">
                            Alquilar
                        </button>
                    </form>
                @else
                    <div class="alert alert-warning mt-4">
                        Debes <a href="{{ route('login') }}">iniciar sesión</a> para alquilar.
                    </div>
                @endauth
            </div>
        </div>
    </div>

</div>
@endsection
