<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
