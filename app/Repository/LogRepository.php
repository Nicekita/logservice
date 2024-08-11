<?php

namespace App\Repository;

use App\Enums\Frequency;
use App\Models\Service;
use App\Models\SyncLog;

class LogRepository
{

    public function __construct(private SyncLog $logs)
    {
    }

    /**
     * Учитываем то, что проверка идет каждую минуту.
     * В зависимости от частоты, добавляем погрешность, т.е. если за 5 часов должно быть 20 логов,
     * то проверяем за последние 5ч + (5ч / 20) = 5ч 15мин
     *
     * @param Frequency $frequency
     * @param int $interval
     * @param int $count
     * @return array[Carbon, Carbon]
     */

    private function getTime(Frequency $frequency, int $interval, int $count): array
    {
        $marginOfError = $interval / $count;

        $interval = $interval + $marginOfError;

        $seconds = match ($frequency) {
            Frequency::SECONDLY => $interval,
            Frequency::MINUTELY => $interval * 60,
            Frequency::HOURLY => $interval * 60 * 60,
            Frequency::DAILY => $interval * 60 * 60 * 24,
            Frequency::WEEKLY => $interval * 60 * 60 * 24 * 7,
            Frequency::MONTHLY => $interval * 60 * 60 * 24 * 30,
            Frequency::YEARLY => $interval * 60 * 60 * 24 * 365,
        };

        $seconds = ceil($seconds);

        $firstTime = now()->subSeconds($seconds);

        return [$firstTime, now()];

    }

    private function latestLogs(Service $service)
    {
        $interval = $this->getTime($service->freq, $service->interval, $service->count);
        return $this->logs->where('service_id', $service->id)
            ->whereBetween('created_at', $interval)
            ->orderBy('created_at', 'desc');
    }
    public function getLatestLogs(Service $service): array
    {
        return $this->latestLogs($service)->get()->toArray();
    }

    public function getLatestLogsCount(Service $service): int
    {
        return $this->latestLogs($service)->count();
    }

}
