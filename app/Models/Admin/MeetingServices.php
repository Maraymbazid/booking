<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MeetingSalles;

class MeetingServices extends Model
{
    use HasFactory;
    protected $table = 'services_meeting';
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
    public function meetings()
    {
        return $this->belongsToMany(MeetingSalles::class,'pivot_four','service_id','salle_id');
    }




}
