<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Service;

class Hotel extends Model
{
    use HasFactory;

   protected $table = 'hotels';
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'sort',
        'status',
        'gouvernement',
        'description_en',
        'description_ar'
    ];
    public function services()
    {
        return $this->belongsToMany(Service::class,'hotel_services','hotel_id','service_id');
    }
}
