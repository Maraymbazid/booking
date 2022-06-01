<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;

class DiscountApartement extends Model
{
    use HasFactory;
    protected $table = 'discountapartement'; 
    protected $fillable = [
        'id',
        'apartement_id',
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
    public function apartement()
    {
        return $this->belongsTo(Apartement::class,'apartement_id');
    }
}
