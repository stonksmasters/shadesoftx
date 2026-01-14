<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
        'admin_notes',
        'read_at',
        'assigned_to',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function assignedAdmin()
    {
        return $this->belongsTo(AdminUser::class, 'assigned_to');
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }
}
