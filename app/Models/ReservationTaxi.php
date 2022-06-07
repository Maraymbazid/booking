<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationTaxi extends Model
{
    use HasFactory;
    protected $table = 'reservationtaxi';

    protected $fillable =
    [
        'id',
        'user_id',
        'taxi_id',
        'Num',
        'price',
        'deliveryplace',
        'nationality',
        'datearrive',
        'destination',
        'chauffeur',
        'ticket',
        'status',
    ];
    protected $timestamp = false;
}
