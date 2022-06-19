<?php

namespace App\Models;

use App\Models\Admin\Room;
use App\Models\Admin\Service;
use App\Models\ServicesHotel;
use App\Models\SubServicesHotel;
use App\Models\MainServicesHotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin\Gouvernement;
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

    public function gouvernemente()
    {

        return $this->belongsTo(Gouvernement::class, 'gouvernement');
    }
    public function images()
    {
        return $this->hasMany(HotelImage::class, 'hotel_id');
    }
    // public function getCoverAttribute($val)
    // {
    //     return ($val !== null) ? asset('assets/admin/img/hotels/cover/' . $val) : "";
    // }
}
