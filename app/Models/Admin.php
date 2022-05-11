<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'id',
        'email',
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
    ];
}

