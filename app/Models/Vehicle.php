<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'make', 'capacity', 'image'];

    // Define the relationship with Transport
    public function transport()
    {
        return $this->hasMany(Transport::class, 'vehicle_id');
        
    }

    public function transports()
    {
        return $this->belongsToMany(Route::class, 'transports', 'vehicle_id', 'route_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    
}
