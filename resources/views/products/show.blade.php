@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
            <img src="{{ $product->image_url ?? ($product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/800x400') }}"
            class="img-fluid rounded shadow-sm mb-3"
            style="max-height: 400px; width: 100%; object-fit: cover;">
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h2 class="fw-bold">{{ $product->title }}</h2>
                <p class="text-muted">{{ $product->description }}</p>

                <p class="fs-4 fw-bold text-success">Q{{ $product->price_per_day }} / día</p>

                <div class="alert alert-warning">

                <strong>Depósito de garantía:</strong>

                Se realizará una retención temporal para proteger al dueño del producto.

                </div>
                <!-- reseña -->

                                @php
                    $avg = round($product->reviews->avg('rating'), 1);
                @endphp

                <p class="mb-1">
                    <strong>Calificación:</strong>
                    <span class="text-warning fw-bold">
                        {{ $avg ? $avg : 'Sin reseñas' }}
                    </span>
                </p>

                <p>
                    <strong>Total reseñas:</strong> {{ $product->reviews->count() }}
                </p>
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

                        <hr>

                        <h5 class="fw-bold">Método de pago</h5>

                        <div class="mb-3">
                        <select name="payment_method" id="payment_method" class="form-select" required>
                        <option value="">Seleccionar método</option>
                        <option value="cash">Efectivo</option>
                        <option value="card">Tarjeta</option>
                        </select>
                        </div>

                        <div id="card-fields" style="display:none;">

                            <div class="mb-3">
                            <label class="form-label">Nombre del titular</label>
                            <input type="text" name="card_name" class="form-control">
                            </div>

                            <div class="mb-3">
                            <label class="form-label">Número de tarjeta</label>
                            <input type="text" name="card_number" class="form-control" placeholder="1234 5678 9012 3456">
                            </div>

                            <div class="row">
                            <div class="col-md-6 mb-3">
                            <label class="form-label">Expiración</label>
                            <input type="text" name="card_expiry" class="form-control" placeholder="MM/YY">
                            </div>

                            <div class="col-md-6 mb-3">
                            <label class="form-label">CVV</label>
                            <input type="password" name="card_cvv" class="form-control" placeholder="123">
                            </div>
                            </div>
                            </div>

                            <div class="alert alert-info">
                            Pago simulado. No se procesan tarjetas reales.
                            </div>

                            </div>


                            <div class="card bg-light p-3 mb-3">

                            <h6 class="fw-bold">Resumen de pago</h6>

                            <p class="mb-1">
                            Alquiler: Q{{ $product->price_per_day }} / día
                            </p>

                            <p class="mb-1">
                            Depósito estimado:
                            Q{{ $product->price_per_day * 0.5 }}
                            </p>
                            <hr>

    <small class="text-muted">
        El depósito se libera al devolver el producto correctamente.
    </small>

</div>

                        <button class="btn btn-primary w-100">
                            Alquilar
                        </button>
                    </form>

                    <!--FORM TO LEAVE A REVIEW-->
                    <hr class="my-4">

<h5 class="fw-bold">Dejar reseña</h5>

@auth
    <form action="{{ route('reviews.store', $product->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Calificación</label>
            <select name="rating" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="1">⭐ 1</option>
                <option value="2">⭐⭐ 2</option>
                <option value="3">⭐⭐⭐ 3</option>
                <option value="4">⭐⭐⭐⭐ 4</option>
                <option value="5">⭐⭐⭐⭐⭐ 5</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Comentario</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-warning w-100">Publicar reseña</button>
    </form>
@else
    <div class="alert alert-warning">
        Debes <a href="{{ route('login') }}">iniciar sesión</a> para dejar una reseña.
    </div>
@endauth



                @else
                    <div class="alert alert-warning mt-4">
                        Debes <a href="{{ route('login') }}">iniciar sesión</a> para alquilar.
                    </div>
                @endauth
            </div>
        </div>
    </div>

</div>
<hr class="my-4">

<h5 class="fw-bold">Reseñas</h5>

@if($product->reviews->count() > 0)
    @foreach($product->reviews as $review)
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <h6 class="fw-bold mb-1">{{ $review->user->name }}</h6>
                <p class="mb-1 text-warning">
                    Calificación: {{ $review->rating }} ⭐
                </p>
                <p class="mb-0">{{ $review->comment }}</p>
            </div>
        </div>
    @endforeach
@else
    <p class="text-muted">Aún no hay reseñas para este producto.</p>
@endif
<hr class="my-4">

<h5 class="fw-bold text-danger">Reportar producto</h5>

@auth
    <form action="{{ route('reports.store', $product->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Motivo</label>
            <select name="reason" class="form-select" required>
                <option value="">Seleccionar</option>
                <option value="Producto falso">Producto falso</option>
                <option value="Estafa">Estafa</option>
                <option value="Contenido inapropiado">Contenido inapropiado</option>
                <option value="Precio engañoso">Precio engañoso</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-danger w-100">Enviar reporte</button>
    </form>
@else
    <div class="alert alert-warning">
        Debes <a href="{{ route('login') }}">iniciar sesión</a> para reportar.
    </div>
@endauth
<p><strong>Publicado por:</strong> {{ $product->user->name ?? 'Usuario' }}</p>
@auth
    @if(auth()->id() !== $product->user_id)
        <form action="{{ route('chat.start', $product->user_id) }}" method="POST" class="mb-3">
            @csrf
            <button class="btn btn-outline-dark w-100">
                Enviar mensaje al dueño
            </button>
        </form>
    @endif
@endauth

@auth
    @php
        $isFavorite = \App\Models\Favorite::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();
    @endphp

    @if(!$isFavorite)
        <form action="{{ route('favorites.store', $product->id) }}" method="POST" class="mb-3">
            @csrf
            <button class="btn btn-outline-danger w-100">
                ❤️ Agregar a Favoritos
            </button>
        </form>
    @else
        <form action="{{ route('favorites.destroy', $product->id) }}" method="POST" class="mb-3">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger w-100">
                ❌ Quitar de Favoritos
            </button>
        </form>
    @endif
@endauth

@endsection

<script>

document.addEventListener('DOMContentLoaded', function () {

    const paymentMethod = document.getElementById('payment_method');
    const cardFields = document.getElementById('card-fields');

    paymentMethod.addEventListener('change', function () {

        if (this.value === 'card') {
            cardFields.style.display = 'block';
        } else {
            cardFields.style.display = 'none';
        }

    });

});

</script>
