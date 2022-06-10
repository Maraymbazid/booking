<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotOne extends Model
{
    use HasFactory;
    protected $table = 'pivot_one';
    protected $fillable = [
        'id',
        'room_id',
        'service_id'
    ];


}
