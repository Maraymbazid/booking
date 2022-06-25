<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;
class ReservationApartement extends Model
{
    use HasFactory;
    protected $table = 'reservationapartement';
    protected $fillable =
    [
        'id',
        'user_id',
        'apartement_id',
        'apartement_name',
        'dis',
        'finallprice',
        'pricebefore',
        'price',
        'customrname',
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
    public function apartement()
    {
        return $this->belongsTo(Apartement::class,'apartement_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
