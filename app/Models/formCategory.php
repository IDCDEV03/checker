<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class formCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_id',
        'category_id',
        'category_name',
    ];
}
