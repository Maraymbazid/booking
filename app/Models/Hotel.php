<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = ['hotels'];

    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'sort',
        'status',
        'description_en',
        'description_ar'
    ];
}
