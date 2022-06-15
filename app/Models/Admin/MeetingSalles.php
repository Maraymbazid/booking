<?php

namespace App\Models\Admin;

use App\Models\MeetingDiscount;
use App\Models\Admin\MeetingServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingSalles extends Model
{
    use HasFactory;
    protected $table = 'meeting_rooms';
    protected $fillable = [
        'id',
        'name_ar',
        'description_ar',
        'address_ar',
        'image',
        'price',
        'area',
        'status',
        'gouvernement',
        'guest',
        'type',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function services()
    {
        return $this->belongsToMany(MeetingServices::class,'pivot_four','salle_id','service_id');
    }
    public function Discount()
    {
        return $this->hasMany(MeetingDiscount::class, 'salle_id');
    }
}
