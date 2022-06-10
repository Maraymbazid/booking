<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationApartement extends Model
{
    use HasFactory;
    protected $table = 'reservationapartement';
    protected $fillable =
    [
        'id',
        'user_id',
        'apartement_id',
        'price',
        'nationality',
        'numerdays',
        'personnes',
        'begindate',
        'enddate',
        'phone',
        'Num',
        'status',
        'Note',
    ];
    protected $timestamp = false;
   
}
