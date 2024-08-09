<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class agent_form_per extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_id',
        'form_id',   
        'form_per',
        'per_status',
    ];

}
