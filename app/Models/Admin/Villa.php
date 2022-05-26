<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceApartement;

class Villa extends Model
{
    use HasFactory;
    protected $table = 'villas'; 
    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'description_en',
        'description_ar',
        'address_ar',
        'image',
        'status',
        'gouvernement',
        'price',
        'area',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function services()
    {
        return $this->belongsToMany(ServiceApartement::class,'pivot_tree','villa_id','service_id');
    }
}
