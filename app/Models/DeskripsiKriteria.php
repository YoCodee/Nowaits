<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeskripsiKriteria extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'id_kriteria';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_penilaian',
        'kategori',
        'deskripsi',
    ];
}
