<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientVitalSign extends Model
{
    protected $fillable = [
        'patient_visit_id',
        'temperature',
        'blood_pressure',
        'pulse_rate',
        'respiratory_rate',
        'oxygen_saturation',
        'weight',
        'height',
        'recorded_by',
    ];

    public function visit()
    {
        return $this->belongsTo(PatientVisit::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}