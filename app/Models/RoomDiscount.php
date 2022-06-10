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
        'room_id',
        'day_count',
        'discount'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
