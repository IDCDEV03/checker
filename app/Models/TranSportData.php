<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranSportData extends Model
{
    use HasFactory;
    protected $fillable = [
        'ts_agent',
        'ts_name',
        'ts_address',
        'ts_province',
        'ts_amphur',
        'ts_tambon',
        'ts_zipcode',
        'ts_phone',
    ];
}
