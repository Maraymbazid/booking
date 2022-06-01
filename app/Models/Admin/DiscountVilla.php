<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Villa;

class DiscountVilla extends Model
{
    use HasFactory;
    protected $table = 'discountvillas'; 
    protected $fillable = [
        'id',
        'villa_id',
        'gouvernement_id',
        'number_days',
        'rate',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function villa()
    {
        return $this->belongsTo(Villa::class,'villa_id');
    }
}
