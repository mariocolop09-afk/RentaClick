@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Mis Notificaciones</h2>

        <form action="{{ route('notifications.readall') }}" method="POST">
            @csrf
            @method('PATCH')
            <button class="btn btn-sm btn-success">Marcar todas como leídas</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">

            @forelse($notifications as $notification)
                <div class="list-group-item d-flex justify-content-between align-items-start">

                    <div>
                        <h6 class="fw-bold mb-1">
                            {{ $notification->title }}

                            @if(!$notification->is_read)
                                <span class="badge bg-danger">Nuevo</span>
                            @endif
                        </h6>

                        <p class="mb-1">{{ $notification->message }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>

                    @if(!$notification->is_read)
                        <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-sm btn-primary">Leído</button>
                        </form>
                    @endif

                </div>
            @empty
                <div class="p-3">
                    <p class="text-muted mb-0">No tienes notificaciones.</p>
                </div>
            @endforelse

        </div>
    </div>

</div>
@endsection