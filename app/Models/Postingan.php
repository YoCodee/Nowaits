<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Postingan extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_posting';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengguna',
        'id_buah',
        'tipe_postingan',
        'judul_posting',
        'keterangan',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'id_buah');
    }
}
