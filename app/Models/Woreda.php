<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Woreda extends Model
{
        protected $fillable = ['name', 'zone_id', 'description'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
