<?php

namespace App\Models;

use App\Models\Admin\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomDiscount extends Model
{
    use HasFactory;

    protected $table = 'rooms_discount';

    protected $fillable =
    [
        'id',
        'room_id',
        'hotel_id',
        'day_count',
        'discount'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
