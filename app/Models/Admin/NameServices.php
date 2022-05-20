<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\ServiceRoom;

class NameServices extends Model
{
    use HasFactory;
    protected $table = 'nameservices'; 
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
    public function details()
    {
        return $this->hasMany(ServiceRoom::class,'name_id');
    }
}
