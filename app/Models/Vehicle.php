<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'make', 'capacity'];

    // Define the relationship with Transport
    public function transport()
    {
        return $this->hasOne(Transport::class, 'vehicle_id');
    }

    
}
