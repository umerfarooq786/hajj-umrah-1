<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_type_id',
        'price',
        'hotel_id'
    ];

    public function hotel()
    {
        // return $this->hasMany(Route::class, 'route_id');
        return $this->belongsTo(Hotel::class);
    }

    public function mealType()
    {
        return $this->belongsTo(MealType::class, 'meal_type_id');
    }
}
