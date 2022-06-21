<?php

namespace App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Gouvernement;
class Destination extends Model
{
    use HasFactory;
    protected $table = 'destinations'; 
    protected $fillable = [
        'id',
        'name',
        'gouvernement_id',
        'price',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function gouvernement()
    {
       
        return $this->belongsTo(Gouvernement::class,'gouvernement_id');

    }
}
