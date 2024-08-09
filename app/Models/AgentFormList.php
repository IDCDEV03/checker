<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentFormList extends Model
{
    use HasFactory;
    protected $fillable = [
        'agent_id',
        'form_id',   
        'agentform_status',
        'leader_role',
        'company_role',
        'user_role',
    ];
}
