<?php

namespace App\Models;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'image',
        'category',
        'note'
    ];

    // public function hotels()
    // {
    //     return $this->belongsToMany(Hotel::class);
    // }
}
