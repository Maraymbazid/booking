<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function reservations()
    {
        return $this->hasMany(ReservationTaxi::class, 'user_id');
    }
    public function ReservationCar()
    {
        return $this->hasMany(ReservationCar::class, 'user_id');
    }
    public function ReservationAppart()
    {
        return $this->hasMany(ReservationApartement::class, 'user_id');
    }
    public function ReservationVilla()
    {
        return $this->hasMany(ReservationVilla::class, 'user_id');
    }
    public function HotelOrder()
    {
        return $this->hasMany(HotelOrder::class, 'user_id');
    }
}
