<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buah extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_buah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengguna',
        'nama_buah',
        'harga_awal',
        'harga_akhir',
        'stok',
        'gambar',
    ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }

    public function penilaian()
    {
        return $this->hasOne(PenilaianBuah::class, 'id_buah');
    }
}
