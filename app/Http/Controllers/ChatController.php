<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $conversations = Conversation::where('user1_id', $userId)
            ->orWhere('user2_id', $userId)
            ->with(['user1', 'user2'])
            ->latest()
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        $userId = auth()->id();

        if ($conversation->user1_id !== $userId && $conversation->user2_id !== $userId) {
            abort(403);
        }

        $conversation->load(['messages.sender', 'user1', 'user2']);

        return view('chat.show', compact('conversation'));
    }

    public function start(User $user)
    {
        $currentUser = auth()->id();

        if ($user->id === $currentUser) {
            return back()->with('error', 'No puedes enviarte mensajes a ti mismo.');
        }

        $conversation = Conversation::where(function ($q) use ($currentUser, $user) {
            $q->where('user1_id', $currentUser)->where('user2_id', $user->id);
        })->orWhere(function ($q) use ($currentUser, $user) {
            $q->where('user1_id', $user->id)->where('user2_id', $currentUser);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user1_id' => $currentUser,
                'user2_id' => $user->id
            ]);
        }

        return redirect()->route('chat.show', $conversation->id);
    }

    public function send(Request $request, Conversation $conversation)
    {
        $userId = auth()->id();

        if ($conversation->user1_id !== $userId && $conversation->user2_id !== $userId) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        Message::create([
            'conversation_id' => $conversation->id,
            'sender_id' => $userId,
            'message' => $request->message
        ]);

        return back();
    }
}
