<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cinema extends Model
{
    // mendaftar softDeletes
    use SoftDeletes;

    protected $fillable = [
        'name',
        'location',
    ];

    public function schedules()
    {
        // pendefinisian jenis relasi ( one to one / one to many )
        // one to one = hasOne
        // one to many = hasMany
        return $this->hasMany(Schedule::class);
    }
}


