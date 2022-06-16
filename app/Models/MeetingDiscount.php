<?php

namespace App\Models;

use App\Models\Admin\MeetingSalles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingDiscount extends Model
{
    use HasFactory;

    protected $table = 'meetings_discount';

    protected $fillable =
    [
        'salle_id',
        'day_count',
        'discount'
    ];


    public function meetings()
    {
        return $this->belongsTo(MeetingSalles::class, 'salle_id');
    }
}
