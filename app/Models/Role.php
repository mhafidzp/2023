<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'role';

    protected $fillable = ['name'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'role');
    }
}
