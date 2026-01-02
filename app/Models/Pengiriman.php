<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pengiriman extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pengirimans';
    protected $primaryKey = 'id_pengiriman';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_transaksi',
        'ekspedisi',
        'no_resi',
        'foto_bukti_kirim',
        'catatan',
        'tgl_dikirim',
        'tgl_diterima',
        'status',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
