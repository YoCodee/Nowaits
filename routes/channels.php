<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{conversationId}', function ($user, $conversationId) {
    $conversation = \App\Models\Conversation::find($conversationId);
    // Cek apakah user yang login adalah peserta di percakapan ini
    return $user->id_pengguna === $conversation->user_one_id || 
           $user->id_pengguna === $conversation->user_two_id;
});
