<?php

namespace App\Http\Controllers;

use App\Http\Requests\LogSyncRequest;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private readonly Service $serviceModel)
    {
    }
    public function index()
    {
        $services = $this->serviceModel->all();
        return response()->json($services);
    }
}
