<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartement extends Model
{
    protected $table = 'apartments'; 
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'status',
        'gouvernement',
        'description_en',
        'description_ar',
        'address_ar',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
