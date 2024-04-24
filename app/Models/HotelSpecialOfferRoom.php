<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSpecialOfferRoom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'package_id',
        'room_id',
        'price'
    ];

    public function specialOffer()
    {
        return $this->belongsTo(HotelSpecialOffer::class, 'package_id');
    }
}
