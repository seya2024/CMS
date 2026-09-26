<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{

    protected $guarded = [];

    protected $casts = [
        'arrived_at' => 'datetime',
        'called_at' => 'datetime',
        'service_start_at' => 'datetime',
        'served_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Calculate current waiting time or total time waited.
     */
    public function getWaitingTimeMinutesAttribute(): ?int
    {
        $start = $this->arrived_at;
        
        if (!$start) {
            return null;
        }

        // If currently waiting or called, calculate from arrived_at to NOW
        if (in_array($this->status, ['waiting', 'called'])) {
            return (int) $start->diffInMinutes(Carbon::now());
        }

        // If finished (served/skipped/cancelled), calculate from arrived_at to called_at
        if (!is_null($this->called_at)) {
            return (int) $start->diffInMinutes($this->called_at);
        }

        return null;
    }

    /**
     * Calculate how long the doctor actually spent with the patient.
     */
    public function getServiceDurationAttribute(): ?int
    {
        if (!is_null($this->service_start_at) && !is_null($this->served_at)) {
            return (int) $this->service_start_at->diffInMinutes($this->served_at);
        }
        
        return null;
    }

    /**
     * Auto-generate the next token number when creating a queue entry.
     */
    public static function generateToken(string $prefix, int $departmentId): string
    {
        $today = Carbon::today()->toDateString();
        
        $lastToken = static::where('queue_date', $today)
            ->where('department_id', $departmentId)
            ->where('token_number', 'like', "$prefix-%")
            ->orderByDesc('id')
            ->value('token_number');

        $nextNumber = 1;
        
        if ($lastToken) {
            // Extract the numeric part (e.g., 'A-005' becomes 5)
            $parts = explode('-', $lastToken);
            $nextNumber = (int) end($parts) + 1;
        }

        return $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT); // e.g., A-001
    }
}