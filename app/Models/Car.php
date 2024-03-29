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
        'meth',
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
    protected static function booted()
    {    
            self::deleting(function($car) { 
                $car->images()->each(function($image) {
                    deleteMedia($image->image, 'cars/covers/');
                    $image->delete(); 
                });
                $car->discount()->each(function($discount) {
                    $discount->delete(); 
                });
                $oldImage=$car->image;
                deleteMedia($oldImage, 'cars');
            });
    }
}
