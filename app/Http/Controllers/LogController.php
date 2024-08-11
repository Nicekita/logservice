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
        $request = $request->validated();

        $service = $this->services->where('key', $request['key'])->first();
        if (!$service) {
            $service = $this->services->create($request);
        } else {
            $service->update($request);
        }


        $additionalData = $request['data'] ?? [];
        $this->logs->create([
            'service_id' => $service->id,
            'data' => $additionalData,
            'status' => $request['status'],
        ]);

        if (!$request['status']) {
            ServiceBroken::dispatch($service, $additionalData);
            return response()->json(['message' => 'Log created successfully. Service is broken.']);
        }

        return response()->json(['message' => 'Log created successfully']);
    }
}
