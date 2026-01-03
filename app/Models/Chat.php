<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'id_posting',
        'message',
        'is_read',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id_pengguna');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id_pengguna');
    }

    public function posting()
    {
        return $this->belongsTo(Postingan::class, 'id_posting', 'id_posting');
    }
}
