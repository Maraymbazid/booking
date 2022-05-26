<?php

namespace App\Models;

use App\Models\MainServicesHotel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubServicesHotel extends Model
{
    use HasFactory;

    protected $table = 'sub_services_hotels';
    protected $fillable = [
        'name',
        'main_service_id'
    ];

    public function MainSer()
    {
        $this->belongsTo(MainServicesHotel::class, 'main_service_id', 'id');
    }
}
