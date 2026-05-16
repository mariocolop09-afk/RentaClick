

@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4">Panel Admin</h2>
    <a href="{{ route('admin.reports') }}" class="btn btn-danger mb-3">
    Ver Reportes
</a>
    <div class="row g-4">

        <div class="col-md-12">
            <div class="card shadow-sm p-3">
                <h4 class="fw-bold">Productos pendientes de aprobación</h4>

                <div class="table-responsive">
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Usuario</th>
                                <th>Precio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingProducts as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->user->name ?? 'User' }}</td>
                                    <td>Q{{ $product->price_per_day }}</td>
                                    <td>
                                        <form action="{{ route('admin.products.approve', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-sm">Aprobar</button>
                                        </form>

                                        <form action="{{ route('admin.products.reject', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay productos pendientes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm p-3">
                <h4 class="fw-bold">Productos aprobados</h4>

                <div class="table-responsive">
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Disponible</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($approvedProducts as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>
                                        @if($product->is_available)
                                            <span class="badge bg-success">Sí</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.products.toggle', $product->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-warning btn-sm">
                                                Cambiar disponibilidad
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay productos aprobados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow-sm p-3">
                <h4 class="fw-bold">Usuarios registrados</h4>

                <div class="table-responsive">
                    <table class="table table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="badge bg-success">Sí</span>
                                        @else
                                            <span class="badge bg-secondary">No</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
