@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-3">Mis Favoritos</h2>

    <div class="row g-4">
        @forelse($favorites as $fav)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">

                    <img src="{{ $fav->product->image ? asset('storage/'.$fav->product->image) : 'https://via.placeholder.com/400x250' }}"
                         class="card-img-top" style="height: 200px; object-fit: cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $fav->product->title }}</h5>
                        <p class="fw-bold text-success">${{ $fav->product->price_per_day }} / día</p>

                        <a href="{{ route('products.show', $fav->product->id) }}" class="btn btn-primary w-100 mb-2">
                            Ver producto
                        </a>

                        <form action="{{ route('favorites.destroy', $fav->product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger w-100">Quitar</button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <p class="text-muted">No tienes productos en favoritos.</p>
        @endforelse
    </div>

</div>
@endsection
