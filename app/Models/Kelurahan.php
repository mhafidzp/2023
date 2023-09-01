<?php

namespace App\Models;

use App\Observers\KelurahanObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelurahan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'kode';
    protected $keyType = 'string';
    protected $table = 'kelurahan';

    protected $fillable = [
        'kode',
        'kecamatan_kode',
        'nama',
        'slug',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
