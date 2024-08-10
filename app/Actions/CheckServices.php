<?php

namespace App\Actions;

use App\Enums\Frequency;
use App\Events\ServiceBroken;
use App\Models\Service;
use App\Models\SyncLog;

class CheckServices
{

    public function __construct(
        private readonly Service       $services,
        private readonly SyncLog       $logs,
    )
    {
    }


    public function execute(): void
    {
        $services = $this->services->all();

        foreach ($services as $service) {
            if ($errorData = $this->getServiceError($service)) {
                ServiceBroken::dispatch($service, $errorData);
            };
        }

    }

    private function getTime(Frequency $frequency, int $interval): array
    {
        $firstTime = match ($frequency) {
            Frequency::SECONDLY => now()->subSeconds($interval),
            Frequency::MINUTELY => now()->subMinutes($interval),
            Frequency::HOURLY => now()->subHours($interval),
            Frequency::DAILY => now()->subDays($interval),
            Frequency::WEEKLY => now()->subWeeks($interval),
            Frequency::MONTHLY => now()->subMonths($interval),
            Frequency::YEARLY => now()->subYears($interval),
        };

        return [$firstTime, now()];

    }

    private function getServiceError(Service $service): array|null
    {
        $interval = $this->getTime($service->rrule['freq'], $service->rrule['interval']);
        $actualLogs = $this->logs->where('service_id', $service->id)
            ->whereBetween('created_at', $interval)->count();

        if ($actualLogs < $service->rrule['count']) {
            return [
                'last_log' => $this->logs->where('service_id', $service->id)->latest()->first(),
                //TODO: Add more data
            ];
        }

        return null;
    }
}
