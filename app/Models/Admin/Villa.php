<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceApartement;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\DiscountVilla;
use App\Models\ReservationVilla;
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
    public function gouvernemente()
    {
       
        return $this->belongsTo(Gouvernement::class,'gouvernement');

    }
    public function discounts()
    {
        return $this->hasMany(DiscountVilla::class,'villa_id');
    }
    public function reservations()
    {
        return $this->hasMany(ReservationVilla::class,'villa_id');
    }
}
