<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
class ImageCar extends Model
{
    use HasFactory;
    protected $table = 'imagescars';
    protected $fillable = [
        'id',
        'car_id',
        'image',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class,'car_id');
    }
}
