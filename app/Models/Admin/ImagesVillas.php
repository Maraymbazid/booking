<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Villa;
class ImagesVillas extends Model
{
    use HasFactory;
    protected $table = 'imagesvillas';
    protected $fillable = [
        'id',
        'villa_id',
        'image',
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
