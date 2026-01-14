<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function assignedAppointments()
    {
        return $this->hasMany(Appointment::class, 'assigned_to');
    }

    public function assignedMessages()
    {
        return $this->hasMany(ContactMessage::class, 'assigned_to');
    }
}
