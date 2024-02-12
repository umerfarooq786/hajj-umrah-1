<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'excerpt',
        'description',
        'google_map',
        'city',
        'validity'
    ];
    public function specialOffers()
    {
        return $this->hasMany(HotelSpecialOffer::class, 'hotel_id');
    }
    public function costs()
    {
        return $this->morphMany(Cost::class, 'item');
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
