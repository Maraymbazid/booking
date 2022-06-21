<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReservationTaxi;
use App\Models\Company;
use App\Models\Admin\PromoCode;
use App\Models\Admin\ImageTaxi;
class Taxi extends Model
{
    use HasFactory;

    protected $table = 'taxis';

    protected $fillable =
    [
        'id',
        'name',
        'image',
        'company_id',
        'price',
        'model',
    ];
    protected $timestamp = false;
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function reservations()
    {
        return $this->hasMany(ReservationTaxi::class,'taxi_id');
    }
    public function promos()
    {
        return $this->hasMany(PromoCode::class,'taxi_id');
    }
    public function images()
    {
        return $this->hasMany(ImageTaxi::class,'taxi_id');
    }
    protected static function booted()
    {    
            self::deleting(function($taxi) { 
                $taxi->images()->each(function($image) {
                    deleteMedia($image->image, 'taxi/covers/');
                    $image->delete(); 
                });
                $taxi->promos()->each(function($promo) {
                    $promo->delete(); 
                });
                $oldImage=$taxi->image;
                deleteMedia($oldImage, 'taxi');
            });
    }

}
