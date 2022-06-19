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
        'hour_count',
        'discount',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function meeting()
    {
        return $this->belongsTo(MeetingSalles::class, 'salle_id');
    }
}
