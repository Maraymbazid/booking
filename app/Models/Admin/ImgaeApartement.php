<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Apartement;
class ImgaeApartement extends Model
{
    use HasFactory;
    protected $table = 'imagesapartements';
    protected $fillable = [
        'id',
        'apartement_id',
        'image',
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
