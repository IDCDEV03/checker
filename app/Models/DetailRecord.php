<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRecord extends Model
{
    use HasFactory;
    protected $fillable = [  
        'user_dep',
        'user_id',     
        'std_id',  
        'form_id_chk',
        'round_chk',
    ];
}
