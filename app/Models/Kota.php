<?php

namespace App\Models;

use App\Observers\KotaObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kota extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    protected $table = 'kota';

    protected $fillable = [
        'kode',
        'provinsi_kode',
        'nama',
        'slug',
    ];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'kota_kode');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
}
