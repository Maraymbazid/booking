<?php

namespace App\Models;

use App\Models\SubServicesHotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainServicesHotel extends Model
{
    use HasFactory;
    public $table = 'main_services_hotels';
    public $fillable = [
        'name'
    ];

    public function SubSer()
    {
        $this->hasMany(SubServicesHotel::class, 'main_service_id', 'id');
    }
}
