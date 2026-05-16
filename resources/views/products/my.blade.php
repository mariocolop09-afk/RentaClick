@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Mis productos</h2>
        <a href="{{ route('products.create') }}" class="btn btn-success">+ Publicar</a>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x250' }}"
     class="card-img-top"
     style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $product->title }}</h5>
                        <p class="fw-bold">Q{{ $product->price_per_day }} / día</p>

                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning w-100 mb-2">Editar</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p>No tienes productos publicados.</p>
        @endforelse
    </div>

</div>
@endsection
