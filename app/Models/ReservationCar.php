<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
class ReservationCar extends Model
{
    use HasFactory;
    protected $table = 'reservationcar';

    protected $fillable =
    [
        'id',
        'user_id',
        'car_id',
        'car_model',
        'car_name',
        'customrname',
        'price',
        'show',
        'method',
        'mainPrice',
        'beforeDis',
        'discount',
        'deliveryplace',
        'receivingplace',
        'numberdays',
        'number',
        'date',
        'Num',
        'status',
        'note',
    ];
    protected $timestamp = false;
    public function car()
    {
        return $this->belongsTo(Car::class,'car_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
