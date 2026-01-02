<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBuah extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_penilaian';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_buah',
        'skor_kulit',
        'deskripsi_kulit',
        'skor_bentuk',
        'deskripsi_bentuk',
        'skor_tekstur',
        'deskripsi_tekstur',
        'total_skor_akhir',
    ];

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'id_buah');
    }
}
