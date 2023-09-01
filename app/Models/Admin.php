<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'admin';

    protected $fillable = ['name','email','password','role'];

    public function role()
    {
        return $this->hasOne(Role::class, 'id');
    }
}
