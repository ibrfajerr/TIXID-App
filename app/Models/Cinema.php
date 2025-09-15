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
}


