<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\NameServices;
use App\Models\Admin\Room;

class ServiceRoom extends Model
{
    use HasFactory;
    protected $table = 'services_rooms'; 
    protected $fillable = [
        'id',
        'name',
        'name_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function parent()
    {
        return $this->belongsTo(NameServices::class,'name_id');
    }
    public function rooms()
    {
        return $this->belongsToMany(Room::class,'pivot_one','service_id','room_id');
    }
}
