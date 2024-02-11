<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSpecialOffer extends Model
{
    use HasFactory;
    protected $table = 'hotel_special_offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hotel_id',
        'package_name',
        'start_date',
        'end_date'
    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function rooms()
    {
        return $this->hasMany(HotelSpecialOfferRoom::class, 'package_id');
    }
}
