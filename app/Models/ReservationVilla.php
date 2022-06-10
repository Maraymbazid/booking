<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationVilla extends Model
{
    use HasFactory;
    protected $table = 'reservationvilla';
    protected $fillable =
    [
        'id',
        'user_id',
        'villa_id',
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
