<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taxi;
class PromoCode extends Model
{
    use HasFactory;
    protected $table = 'promocode';
    protected $fillable = [
        'id',
        'name',
        'status',
        'begindate',
        'enddate',
        'personnes',
        'taxi_id',
        'discount',
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
