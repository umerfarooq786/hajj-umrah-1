<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function transport()
    {
        return $this->morphTo();
        // return $this->hasMany(Transport::class, 'route_id');
    }
}
