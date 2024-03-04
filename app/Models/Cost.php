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
        'validity',
        'current_currency'

    ];

    public function item()
    {
        return $this->morphTo();
    }

    public function transport()
    {
        return $this->morphTo();
    }
}
