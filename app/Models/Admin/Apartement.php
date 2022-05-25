<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceApartement;

class Apartement extends Model
{
    protected $table = 'apartments'; 
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'image',
        'status',
        'gouvernement',
        'price',
        'area',
        'description_en',
        'description_ar',
        'address_ar',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function services()
    {
        return $this->belongsToMany(ServiceApartement::class,'pivot_two','apartement_id','service_id');
    }
}
