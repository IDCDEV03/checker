<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_choice extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_id',
        'category_id',   
        'form_choice',
        'choice_type',
    ];
}
