<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingAgent extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'vid_company',
        'vid_um',
        'file_um',
        'file_brochure',
        'file_roadmap',
    ];
}
