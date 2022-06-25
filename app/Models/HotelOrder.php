<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelOrder extends Model
{
    use HasFactory;


    protected $table = 'hotel_orders';

    protected $fillable =
    [
        'hotel_id',
        'room_id',
        'hotel_name',
        'room_name',
        'order_number',
        'name',
        'day_count',
        'discount',
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
    public function user()
    {

        return  $this->belongsTo(User::class, 'user_id');
    }
}
