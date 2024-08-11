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

        if (count($actualLogs) < $service->rrule['count']) {
            $lastLog = last($actualLogs);
            return [
                'service_id' => $service->id,
                'data' => $lastLog['data'],
            ];
        }

        return null;
    }
}
