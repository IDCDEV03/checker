<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_car_data extends Model
{
    use HasFactory;
    protected $fillable = [      
        'user_id',   
        'form_id',    
        'car_plate',          
        'car_province',
        'car_status',
        'car_type',
    ];
}
