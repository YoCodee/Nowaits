<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Penawaran extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_penawaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_permintaan',
        'id_petani',
        'id_buah',
        'harga_tawaran',
        'pesan',
        'status',
    ];

    public function permintaan()
    {
        return $this->belongsTo(PermintaanMitra::class, 'id_permintaan');
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'id_petani');
    }

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'id_buah');
    }
}
