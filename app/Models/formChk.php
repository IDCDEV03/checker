<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formChk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_id',
        'form_name',
        'form_type',
        'form_category',
        'form_status'
    ];
}
