<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;
use App\Models\Admin\Apartement\Villa;
use App\Models\Hotel;
use App\Models\Admin\Destination;
class Gouvernement extends Model
{
    use HasFactory;
    protected $table = 'gouvernements';
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
        return $this->hasMany(Apartement::class,'gouvernement');
    }
    public function villas()
    {
        return $this->hasMany(Villa::class,'gouvernement');
    }
    public function hotels()
    {
        return $this->hasMany(Hotel::class,'gouvernement');
    }
    public function destinations()
    {
        return $this->hasMany(Destination::class,'gouvernement_id');
    }
    
}
