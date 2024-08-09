<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchName extends Model
{
    use HasFactory;
    protected $fillable = [  
        'id_branch',
        'branch_name',   
       
    ];
}
