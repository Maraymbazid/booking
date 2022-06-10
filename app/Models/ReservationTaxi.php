<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taxi;
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
        'number',
        'status',
        'Note',
    ];
    protected $timestamp = false;
    public function taxi()
    {
        return $this->belongsTo(Taxi::class,'taxi_id');
    }
}
