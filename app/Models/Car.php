<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable =
    [
        'id',
        'name',
        'image',
        'company_id',
        'price',
        'model',
    ];

    protected $timestamp = true;
}
