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
        'taxi_name',
        'taxi_model',
        'pro',
        'discount',
        'finallprice',
        'destination_name',
        'destination',
        'Num',
        'price',
        'deliveryplace',
        'customername',
        'datearrive',

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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
