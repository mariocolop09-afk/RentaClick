@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Productos en alquiler</h2>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control"
            placeholder="Buscar producto..." value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="category_id" class="form-select">
            <option value="">Todas las categorías</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-dark w-100">Buscar</button>
    </div>
</form>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x250' }}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $product->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <p class="fw-bold">${{ $product->price_per_day }} / día</p>
                        <p class="text-warning mb-2">
                        ⭐ {{ round($product->reviews_avg_rating, 1) ?? '0' }}
                        </p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100">
                            Ver detalle
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

</div>
@endsection
