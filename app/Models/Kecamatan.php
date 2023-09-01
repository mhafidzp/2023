<?php

namespace App\Models;

use App\Observers\KecamatanObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    protected $table = 'kecamatan';

    protected $fillable = [
        'kode',
        'kota_kode',
        'nama',
        'slug',
    ];

    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class, 'kecamatan_kode');
    }

    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
}
