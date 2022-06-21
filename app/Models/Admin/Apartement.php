<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceApartement;
use App\Models\Admin\Gouvernement;
use App\Models\Admin\DiscountApartement;
use App\Models\Admin\ImgaeApartement;
use App\Models\ReservationApartement;
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
    public function gouvernemente()
    {
       
        return $this->belongsTo(Gouvernement::class,'gouvernement');

    }
    public function discounts()
    {
        return $this->hasMany(DiscountApartement::class,'apartement_id');
    }
    public function reservations()
    {
        return $this->hasMany(ReservationApartement::class,'apartement_id');
    }
    public function images()
    {
        return $this->hasMany(ImgaeApartement::class,'apartement_id');
    }
    protected static function booted()
    {
            self::deleting(function($apartement) {
                $apartement->images()->each(function($image) {
                    deleteMedia($image->image, 'apartements/covers/');
                    $image->delete(); 
                });
                $apartement->services()->detach();
                $apartement->discounts()->each(function($discount) {
                    $discount->delete(); 
                });
                $oldImage=$apartement->image;
                deleteMedia($oldImage, 'apartements');
            });
    }
}
