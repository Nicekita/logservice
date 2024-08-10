<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = [
        'key',
        'rrule',
    ];

    protected $casts = [
        'rrule' => 'array',
    ];
    public $timestamps = false;
}
