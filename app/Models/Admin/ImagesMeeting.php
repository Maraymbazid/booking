<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\MeetingSalles;
class ImagesMeeting extends Model
{
    use HasFactory;
    protected $table = 'imagesmeetings';
    protected $fillable = [
        'id',
        'meeting_id',
        'image',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function meeting()
    {
        return $this->belongsTo(MeetingSalles::class,'meeting_id');
    }
}
