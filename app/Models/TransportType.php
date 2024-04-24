<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function transport()
    {
        return $this->hasOne(Transport::class, 'transport_type_id');
    }
    
}
