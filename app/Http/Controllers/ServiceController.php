<?php

namespace App\Http\Controllers;

use App\Enums\Frequency;
use App\Models\Service;
use App\Repository\LogRepository;

class ServiceController extends Controller
{
    public function __construct(private readonly Service $serviceModel, private readonly LogRepository $logs)
    {
    }
    public function index()
    {
        $services = $this->serviceModel->all()->map(function (Service $service) {
            $service->logs_count = $this->logs->getLatestLogsCount($service);
            $service->status = $service->logs_count >= $service->count;
            $service->translate_frequency = Frequency::translate($service->freq);
            return $service;
        });
        return view('dashboard', [
            'services' => $services
        ]);
    }

}
