<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    protected $fillable = [

    'mrn',
    'first_name',
    'father_name',
    'grandfather_name',
    'sex',
    'dob',
    'region_id',
    'zone_id',
    'woreda_id',
    'kebele',
    'house_no',
    'phone',
    'email',
    'emergency_contact_name',
    'emergency_contact_phone',
    'national_id',

    // System flags
    'is_active',
    'created_at',
    'updated_at',
    'regisred_by',
    'is_deceased',
    'death_date',
];

protected $casts = [
    'dob' => 'datetime',
];

public function region()
{
    return $this->belongsTo(Region::class);
}

public function zone()
{
    return $this->belongsTo(Zone::class);
}

public function woreda()
{
    return $this->belongsTo(Woreda::class);
}

// public function visits()
// {
//     return $this->hasMany(PatientVisit::class);
// }

    public function visits()
{
    return $this->hasMany(PatientVisit::class)->orderByDesc('check_in_time')->orderByDesc('id'); 
}


   public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setFatherNameAttribute($value)
    {
        $this->attributes['father_name'] = strtoupper($value);
    }

    public function setGrandfatherNameAttribute($value)
    {
        $this->attributes['grandfather_name'] = strtoupper($value);
    }

   protected static function booted()
    {
        static::creating(function ($patient) {

            if (!$patient->mrn) {
                $patient->mrn = self::generateMpiNumber();
            }
        });
    }

    public static function generateMpiNumber(): string
    {
        $year = date('Y');

        $last = self::where('mrn', 'like', "MPI-$year-%")
            ->orderBy('id', 'desc')
            ->first();

        $next = $last
            ? ((int) substr($last->mrn, -6) + 1)
            : 1;

        return 'MPI-' . $year . '-' . str_pad($next, 6, '0', STR_PAD_LEFT);
    }


    public function getAgeDisplayAttribute(): string
    {
        if (!$this->dob) {
            return '-';
        }

        $dob = Carbon::parse($this->dob);
        $now = Carbon::now();

        if ($dob->gt($now)) {
            return '-';
        }

        // (int) guarantees the number is a whole integer (13.48 becomes 13)
        $totalHours = (int) $dob->diffInHours($now);
        $totalDays = (int) $dob->diffInDays($now);
        $totalMonths = (int) $dob->diffInMonths($now);
        $totalYears = (int) $dob->diffInYears($now);

        // 1. Less than 24 hours
        if ($totalHours < 24) {
            return $totalHours <= 1 ? '< 1 hour old' : "{$totalHours} hours old";
        }

        // 2. Less than 30 days
        if ($totalDays < 30) {
            return $totalDays === 1 ? '1 day old' : "{$totalDays} days old";
        }

        // 3. Less than 12 months
        if ($totalYears < 1) {
            return $totalMonths === 1 ? '1 month old' : "{$totalMonths} months old";
        }

        // 4. 1 year or more
        return $totalYears === 1 ? '1 year old' : "{$totalYears} years old";
    }
}
