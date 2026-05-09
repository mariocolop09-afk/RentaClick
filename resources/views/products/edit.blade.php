@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="fw-bold mb-3">Editar producto</h3>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="title" class="form-control" value="{{ $product->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio por día</label>
                <input type="number" name="price_per_day" class="form-control" value="{{ $product->price_per_day }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen (URL)</label>
                <input type="text" name="image_url" class="form-control" value="{{ $product->image_url }}">
            </div>

            <button class="btn btn-primary w-100">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection
