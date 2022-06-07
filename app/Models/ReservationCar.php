<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'nationality',
        'deliveryplace',
        'receivingplace',
        'numberdays',
        'number',
        'date',
        'chauffeur',
        'Num',
        'status',
    ];
    protected $timestamp = false;
}
