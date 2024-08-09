<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chk_record_form extends Model
{
    use HasFactory;
    protected $fillable = [  
        'user_id',     
        'car_id',          
        'car_mileage',
        'round_chk',
    ];
}
