<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    use HasFactory;

    protected $table = 'taxis';

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
