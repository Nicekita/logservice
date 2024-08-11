<?php

namespace App\Repository;

use App\Enums\Frequency;
use App\Models\Service;
use App\Models\SyncLog;

class ServiceRepository
{

    public function __construct(private Service $service)
    {
    }

}
