<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $fillable = [
        'transport_type_id',
        'make',
        'capacity',
        'route_id'
    ];

    public function types()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    
    public function route()
    {
        // return $this->hasMany(Route::class, 'route_id');
        return $this->belongsTo(Route::class);
    }

    public function costs()
    {
        return $this->hasMany(Cost::class, 'item_id');
    }

    // public function transportType()
    // {
    //     return $this->belongsTo(TransportType::class, 'transport_type_id');
    // }

    public function vehicles()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
    
}
