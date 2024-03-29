<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Villa;
class ReservationVilla extends Model
{
    use HasFactory;
    protected $table = 'reservationvilla';
    protected $fillable =
    [
        'id',
        'user_id',
        'villa_id',
        'villa_name',
        'finallprice',
        'discount',
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
    public function villa()
    {
        return $this->belongsTo(Villa::class,'villa_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
