<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_postingan',
        'id_pembeli',
        'id_penjual',
        'jumlah_kg',
        'harga_per_kg',
        'total_harga_barang',
        'biaya_ongkir',
        'jarak_km',
        'alamat_pengiriman_snapshot',
        'total_bayar',
        'status',
        'bukti_bayar',
    ];

    protected $casts = [
        'alamat_pengiriman_snapshot' => 'array',
    ];

    // Relations
    public function postingan()
    {
        return $this->belongsTo(Postingan::class, 'id_postingan');
    }

    public function pembeli()
    {
        return $this->belongsTo(User::class, 'id_pembeli')->with('alamatPengguna');
    }

    public function penjual()
    {
        return $this->belongsTo(User::class, 'id_penjual')->with('alamatPengguna');
    }

    public function pengiriman()
    {
        return $this->hasOne(Pengiriman::class, 'id_transaksi');
    }
}
