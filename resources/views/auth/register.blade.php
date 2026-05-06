@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm p-4">
                <h3 class="fw-bold mb-3 text-center">Registrarse</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmar contraseña</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button class="btn btn-success w-100">Crear cuenta</button>

                    <p class="text-center mt-3 mb-0">
                        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                    </p>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
