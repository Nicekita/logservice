<?php

namespace App\Http\Controllers;

use App\Events\ServiceBroken;
use App\Http\Requests\LogSyncRequest;
use App\Models\Service;
use App\Models\SyncLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(
        private readonly Service $services,
        private readonly SyncLog $logs,
    )
    {
    }
    public function logService(LogSyncRequest $request): JsonResponse
    {
        $data = $request->validated();

        $service = $this->services->where('key', $data['key'])->first();
        if (!$service) {
            $service = $this->services->create([
                'key' => $data['key'],
                'rrule' => $data['rrule'],
            ]);
        }

        if (!$data['status']) {
            $this->logs->create([
                'service_id' => $service->id,
                'data' => $data['data'],
            ]);
            ServiceBroken::dispatch($service, $data['data']);
            return response()->json(['message' => 'Log created successfully']);
        }
        $this->logs->create([
            'service_id' => $service->id,
            'data' => $data['data'],
        ]);

        return response()->json(['message' => 'Log created successfully']);
    }
}
