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
        'route_id',
        'cost',
        'validity'
    ];

    public function types()
    {
        return $this->belongsTo(TransportType::class, 'transport_type_id');
    }
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

}
