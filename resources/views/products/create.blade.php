@extends('layouts.bootstrap')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4">
        <h3 class="fw-bold mb-3">Publicar producto</h3>


        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio por día</label>
                <input type="number" name="price_per_day" class="form-control" required>
            </div>

            <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="image" class="form-control">
            </div> 

            <button class="btn btn-success w-100">Publicar</button>
        </form>
    </div>
</div>
@endsection
