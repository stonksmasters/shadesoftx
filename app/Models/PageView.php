<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    protected $fillable = [
        'page_url',
        'page_name',
        'referrer',
        'ip_address',
        'device_type',
        'session_id',
    ];
}
