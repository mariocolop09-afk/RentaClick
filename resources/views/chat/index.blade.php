@extends('layouts.bootstrap')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Mis Conversaciones</h2>
    </div>

    <div class="card shadow-sm">
        <div class="list-group list-group-flush">

            @forelse($conversations as $conversation)

                @php
                    $otherUser = $conversation->user1_id == auth()->id()
                        ? $conversation->user2
                        : $conversation->user1;
                @endphp

                <a href="{{ route('chat.show', $conversation->id) }}" class="list-group-item list-group-item-action">
                    <strong>{{ $otherUser->name }}</strong>
                    <br>
                    <small class="text-muted">Click para ver mensajes</small>
                </a>

            @empty
                <div class="p-3">
                    <p class="mb-0 text-muted">No tienes conversaciones todavía.</p>
                </div>
            @endforelse

        </div>
    </div>

</div>
@endsection