<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelOrder extends Model
{
    use HasFactory;


    protected $table = 'hotel_orders';

    protected $fillable =
    [
        'hotel_id',
        'room_id',
        'day_count',
        'discount',
        'name',
        'whtsapp',
        'arrival',
        'checkout',
        'price',
        'status',
        'note',
        'total',
        'created_at',
        'updated_at'
    ];
}
