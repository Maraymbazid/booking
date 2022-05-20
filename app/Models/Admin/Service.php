<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hotel;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services'; 
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function hotels()
    {
        return $this->belongsToMany(Hotel::class,'hotel_services','service_id','hotel_id');
    }
}
