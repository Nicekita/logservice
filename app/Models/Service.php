<?php

namespace App\Models;

use App\Enums\Frequency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{

    protected $fillable = [
        'key',
        'count',
        'interval',
        'freq',
    ];

    protected $casts = [
        'freq' => Frequency::class,
    ];

    public $timestamps = false;
}
