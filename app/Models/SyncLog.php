<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncLog extends Model
{


    protected $table = 'logs';
    protected $fillable = [
        'service_id',
        'data',
        'status',
    ];

    protected $casts = [
        'data' => 'array',
    ];
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }


}
