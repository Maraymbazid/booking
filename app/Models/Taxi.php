<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReservationTaxi;
use App\Models\Company;
class Taxi extends Model
{
    use HasFactory;

    protected $table = 'taxis';

    protected $fillable =
    [
        'id',
        'name',
        'image',
        'company_id',
        'price',
        'model',
    ];
    protected $timestamp = false;
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function reservations()
    {
        return $this->hasMany(ReservationTaxi::class,'taxi_id');
    }

}
