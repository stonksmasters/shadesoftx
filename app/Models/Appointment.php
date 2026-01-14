<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'service_type',
        'selected_date',
        'status',
        'admin_notes',
        'source_page',
        'quote_amount',
        'sale_amount',
        'assigned_to',
        'confirmed_at',
        'completed_at',
    ];

    protected $casts = [
        'selected_date' => 'date',
        'confirmed_at' => 'datetime',
        'completed_at' => 'datetime',
        'quote_amount' => 'decimal:2',
        'sale_amount' => 'decimal:2',
    ];

    public function assignedAdmin()
    {
        return $this->belongsTo(AdminUser::class, 'assigned_to');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek(),
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ]);
    }
}
