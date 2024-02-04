<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    use HasFactory;
    protected $fillable = [
        'usd',
        'sar',
        'default_currency'
    ];
}
