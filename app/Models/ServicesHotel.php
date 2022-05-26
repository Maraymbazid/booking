<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesHotel extends Model
{
    use HasFactory;

    protected $table = 'services_hotel';
    protected $fillable = [
        'hotel_id',
        'sub_id'
    ];
}
