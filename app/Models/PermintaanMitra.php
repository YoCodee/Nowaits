<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PermintaanMitra extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_permintaan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengguna',
        'nama_buah_dicari',
        'jumlah_dicari_kg',
        'harga_ajuan_per_kg',
        'min_skor_kualitas',
        'deskripsi_tambahan',
        'status_tawaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function penawarans()
    {
        return $this->hasMany(Penawaran::class, 'id_permintaan');
    }
}
