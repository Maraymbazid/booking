<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingOrder extends Model
{
    use HasFactory;

    protected $table = 'meetingorders';
    protected $fillable = [
        'order_number',
        'meeting_id',
        'user_id',
        'date',
        'start_time',
        'hours',
        'end_time',
        'numberdays',
        'number',
        'persones',
        'customername',
        'main_price',
        'pricebefore',
        'discount',
        'finallPrice',
        'status',
        'note',
    ];

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id');
    }

}
