<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class truck_data_chk extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'ts_agent',
        'form_chk',
        'plate_top',
        'plate_bottom',
        'chk_num',
        'status_chk',
        'round_chk',
    ];
}
