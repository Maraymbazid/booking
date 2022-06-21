<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;
use App\Models\Admin\Villa;
use App\Models\Hotel;
use App\Models\Admin\Destination;
use App\Models\Admin\MeetingSalles;
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
    public function meetings()
    {
        return $this->hasMany(MeetingSalles::class,'gouvernement');
    }
    protected static function booted()
    {
            self::deleting(function($gouvernement) {
                $gouvernement->apartements()->each(function($apartement) {
                    $apartement->delete(); 
                });
                $gouvernement->villas()->each(function($villa) {
                    $villa->delete(); 
                });
                $gouvernement->hotels()->each(function($hotel) {
                    $hotel->delete(); 
                });
                $gouvernement->destinations()->each(function($destination) {
                    $destination->delete(); 
                });
                $gouvernement->meetings()->each(function($meeting) {
                    $meeting->delete(); 
                });
               
            });
    }
    
}
