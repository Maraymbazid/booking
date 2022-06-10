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
        'whatsapp',
        'arrival',
        'checkout',
        'price',
        'status',
        'note',
        'user_id',
        'total',
        'created_at',
        'updated_at'
    ];
}
