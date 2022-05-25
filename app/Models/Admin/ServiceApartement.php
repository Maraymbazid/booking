<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;
use App\Models\Admin\Villa;
class ServiceApartement extends Model
{
    use HasFactory;
    protected $table = 'services_apartements'; 
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
    public function apartements()
    {
        return $this->belongsToMany(Apartement::class,'pivot_two','service_id','apartement_id');
    }
    public function villas()
    {
        return $this->belongsToMany(Villa::class,'pivot_tree','service_id','villa_id');
    }
}
