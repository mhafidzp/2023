<?php

namespace App\Models;

use App\Observers\ProvinsiObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    protected $table = 'provinsi';

    protected $fillable = [
        'kode',
        'nama',
        'slug',
    ];

    public function kota()
    {
        return $this->hasMany(Kota::class, 'provinsi_kode');
    }
}
