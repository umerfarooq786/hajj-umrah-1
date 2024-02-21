<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hotel_rooms';
    protected $fillable = ['room_id', 'hotel_id', 'validity', 'weekdays_price', 'weekend_price', 'current_currency'];
}
