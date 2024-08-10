<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogSyncRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(private Service $serviceModel)
    {

    }
    public function logService(LogSyncRequest $request)
    {
        $data = $request->validated();
        $service = $this->serviceModel->where('key', $data['key'])->first();
        if (!$service) {
            $service = $this->serviceModel->create([
                'key' => $data['key'],
                'rrule' => $data['rrule'],
            ]);
        }
    }
}
