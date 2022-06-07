<?php

namespace App\Models;

use App\Models\Admin\Room;
use App\Models\Admin\Service;
use App\Models\ServicesHotel;
use App\Models\SubServicesHotel;
use App\Models\MainServicesHotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

   protected $table = 'hotels';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'cover',
        'sort',
        'location',
        'status',
        'title',
        'gouvernement',
        'description_en',
        'description_ar'
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class, 'hotel_id');
    }

    public function SubServices()
    {
        return $this->belongsToMany(SubServicesHotel::class, 'services_hotel', 'hotel_id', 'sub_id');
    }

    public function test()
    {
        return $this->hasManyThrough(SubServicesHotel::class, ServicesHotel::class, 'hotel_id', 'sub_id');
    }
}
