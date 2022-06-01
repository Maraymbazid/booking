<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Service;
use App\Models\Admin\Room;
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
    public function services()
    {
        return $this->belongsToMany(Service::class,'hotel_services','hotel_id','service_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class,'hotel_id');
    }
    public function gouvernemente()
    {
       
        return $this->belongsTo(Gouvernement::class,'gouvernement');

    }
}
