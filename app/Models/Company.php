<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\Taxi;
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable =
    [
        'id',
        'name'
    ];

    protected $timestamp = true;
    public function cars()
    {
        return $this->hasMany(Car::class,'company_id');
    }
    public function taxis()
    {
        return $this->hasMany(Taxi::class,'company_id');
    }
}
