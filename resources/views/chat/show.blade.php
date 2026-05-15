@extends('layouts.bootstrap')

@section('content')
<div class="container">

    @php
        $otherUser = $conversation->user1_id == auth()->id()
            ? $conversation->user2
            : $conversation->user1;
    @endphp

    <h2 class="fw-bold mb-3">Chat con {{ $otherUser->name }}</h2>

    <div class="card shadow-sm mb-3" style="height: 400px; overflow-y: auto;">
        <div class="card-body">

            @forelse($conversation->messages as $msg)
                <div class="mb-3">

                    @if($msg->sender_id == auth()->id())
                        <div class="text-end">
                            <div class="d-inline-block bg-primary text-white p-2 rounded">
                                {{ $msg->message }}
                            </div>
                            <br>
                            <small class="text-muted">{{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @else
                        <div class="text-start">
                            <div class="d-inline-block bg-light border p-2 rounded">
                                {{ $msg->message }}
                            </div>
                            <br>
                            <small class="text-muted">{{ $msg->created_at->format('H:i') }}</small>
                        </div>
                    @endif

                </div>
            @empty
                <p class="text-muted">No hay mensajes todavía.</p>
            @endforelse

        </div>
    </div>

    <form action="{{ route('chat.send', $conversation->id) }}" method="POST">
        @csrf

        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Escribe un mensaje..." required>
            <button class="btn btn-success">Enviar</button>
        </div>
    </form>

    <a href="{{ route('chat.index') }}" class="btn btn-secondary mt-3">Volver</a>

</div>
@endsection