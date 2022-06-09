<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
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
}
