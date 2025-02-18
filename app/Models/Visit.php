<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'page_url',
        'ip_address',
        'user_agent',
        'session_id',
        'visit_time',
    ];

}