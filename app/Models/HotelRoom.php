<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hotel_rooms';
<<<<<<< HEAD

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
=======
    protected $fillable = ['room_id', 'hotel_id', 'validity', 'weekdays_price', 'weekend_price', 'current_currency'];
>>>>>>> baef6a64db338e218fa90f7ba6154137ca31c179
}
