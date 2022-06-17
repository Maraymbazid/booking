<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\DiscountCar;
use App\Models\Company;
use App\Models\ReservationCar;
use App\Models\Admin\ImageCar;
class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

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
    public function discount()
    {
        return $this->hasMany(DiscountCar::class,'car_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function reservations()
    {
        return $this->hasMany(ReservationCar::class,'car_id');
    }
    public function images()
    {
        return $this->hasMany(ImageCar::class,'car_id');
    }
}
