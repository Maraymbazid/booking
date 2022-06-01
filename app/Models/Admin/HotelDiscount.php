<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Room;
class  HotelDiscount extends Model
{
    use HasFactory;
    protected $table = 'discounthotels'; 
    protected $fillable = [
        'id',
        'room_id',
        'hotel_id',
        'number_days',
        'rate',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }
}
