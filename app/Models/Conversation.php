<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Conversation extends Model
{
    use HasUuids;
    protected $guarded = [];

    // Relasi ke User
    public function userOne() { return $this->belongsTo(User::class, 'user_one_id'); }
    public function userTwo() { return $this->belongsTo(User::class, 'user_two_id'); }
    
    // Ambil pesan
    public function messages() { return $this->hasMany(Message::class); }

    public function posting(){ return $this->belongsTo(Postingan::class, 'id_posting'); }

    // Relasi ke SATU pesan TERAKHIR (HasOne)
    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'conversation_id')->latestOfMany();
    }
}
