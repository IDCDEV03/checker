<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chkRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_id',
        'user_id',   
        'form_id',    
        'choice_id',          
        'user_chk',
        'round_chk',
        'choice_remark',
        'choice_img',
    ];
}
