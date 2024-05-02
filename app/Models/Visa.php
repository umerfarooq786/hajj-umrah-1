<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = ['hajj_charges', 'umrah_charges','current_currency','show_detail','hajj_commision','umrah_commision'];
}
