@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card shadow-sm p-4">
        <h3 class="fw-bold mb-3">Mi Perfil</h3>

        <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <hr>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
            </div>

            <button class="btn btn-primary w-100">Actualizar perfil</button>
        </form>
    </div>

</div>
@endsection
