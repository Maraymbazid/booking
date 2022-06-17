<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taxi;
class ImageTaxi extends Model
{
    use HasFactory;
    protected $table = 'imagestaxis';
    protected $fillable = [
        'id',
        'taxi_id',
        'image',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function taxi()
    {
        return $this->belongsTo(Taxi::class,'taxi_id');
    }
}
