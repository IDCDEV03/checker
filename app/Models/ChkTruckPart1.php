<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChkTruckPart1 extends Model
{
    use HasFactory;
    protected $fillable = [  
        'user_id',
          'transport_id',
          'truck_id',
          'form_id',
          'chk_round',
          'img_1',
          'img_2',
          'img_3',
          'img_4',
          'img_5',
          'img_6',
          'img_7',
          'img_8',
          'round_id'
    ];
}
