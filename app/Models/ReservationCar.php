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
        'price',
        'customrname',
        'deliveryplace',
        'receivingplace',
        'numberdays',
        'number',
        'date',
        'Num',
        'status',
        'Note',
    ];
    protected $timestamp = false;
    public function car()
    {
        return $this->belongsTo(Car::class,'car_id');
    }
}
