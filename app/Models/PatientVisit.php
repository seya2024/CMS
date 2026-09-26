<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientVisit extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'department_id',
        'checker_id',
        'check_in_time',
        'check_out_time',
        'visit_type',
    ];

    protected $casts = [
    'check_in_time' => 'datetime',
    'check_out_time' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];

    /* ================= RELATIONS ================= */

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    // Attending doctor
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Nurse / triage checker
    public function checker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checker_id');
    }

    // Department (OPD, Surgery, etc.)
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // Vital signs
    public function vitals(): HasMany
    {
        return $this->hasMany(PatientVitalSign::class);
    }


}