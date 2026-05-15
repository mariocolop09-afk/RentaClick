@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <h2 class="fw-bold mb-4">Reportes de Productos</h2>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Producto</th>
                        <th>Motivo</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->product->title }}</td>
                            <td>{{ $report->reason }}</td>
                            <td>{{ $report->description }}</td>
                            <td>
                                @if($report->status == 'pending')
                                    <span class="badge bg-danger">Pendiente</span>
                                @else
                                    <span class="badge bg-success">Resuelto</span>
                                @endif
                            </td>
                            <td>
                                @if($report->status == 'pending')
                                    <form action="{{ route('admin.reports.resolve', $report->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-success">Marcar resuelto</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay reportes.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection