<?php

namespace App\Models\Admin;


use App\Models\Hotel;
use App\Models\Image;
use App\Models\RoomDiscount;
use App\Models\Admin\ServiceRoom;

use App\Models\Admin\HotelDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'id',
        'name_ar',
        'adults',
        'children',
        'area',
        'price',
        'beds',
        'internet',
        'hotel_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function services()
    {
        return $this->belongsToMany(ServiceRoom::class, 'pivot_one', 'room_id', 'service_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function Discount()
    {
        return $this->hasMany(RoomDiscount::class, 'room_id');
    }

    public function Images()
    {
        return $this->hasMany(Image::class, 'room_id');
    }
    protected static function booted()
    {
            self::deleting(function($room) {
                $room->Images()->each(function($image) {
                    deleteMedia($image->name, 'rooms');
                    $image->delete(); 
                });
                $room->services()->detach();
                $room->Discount()->each(function($discount) {
                    $discount->delete(); 
                });
            });
    }
}
