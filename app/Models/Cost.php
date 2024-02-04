<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'item_type',
        'cost',
        
    ];

    public function item()
    {
        return $this->morphTo();
    }
}
