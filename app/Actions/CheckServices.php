<?php

namespace App\Actions;

use App\Events\ServiceBroken;
use App\Models\Service;
use App\Repository\LogRepository;

class CheckServices
{



    public function __construct(
        private readonly Service       $services,
        private readonly LogRepository $logsRepository
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

    private function getServiceError(Service $service): array|null
    {

        $actualLogs = $this->logsRepository->getLatestLogs($service);
        $actualLogsCount = count($actualLogs);
        if ($actualLogsCount < $service->count) {
            $lastLog = last($actualLogs);
            return [
                'service_id' => $service->id,
                'logs_count' => $actualLogsCount,
                'data' => $lastLog['data'] ?? 'There is no logs for this service',
            ];
        }

        return null;
    }
}
