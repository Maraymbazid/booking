<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeeting extends Model
{
    use HasFactory;
    protected $table = 'meetingorders';

    protected $fillable =
    [
        'id',
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
        'created_at',
        'updated_at'

    ];
    protected $timestamp = false;
}
