<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceRoom;
class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms'; 
    protected $fillable = [
        'id',
        'name_ar',
        'adults',
        'children',
        'area',
        'price',
        'image',
        'internet',
        'hotel_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function services()
    {
        return $this->belongsToMany(ServiceRoom::class,'pivot_one','room_id','service_id');
    }
}
