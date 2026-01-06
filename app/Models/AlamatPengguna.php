<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AlamatPengguna extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'alamat_penggunas';
    protected $primaryKey = 'id_alamat';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pengguna',
        'label_alamat', // e.g., 'Rumah', 'Kantor'
        'alamat_lengkap',
        'latitude',
        'longitude',
        'nama_bank',
        'no_rekening',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
