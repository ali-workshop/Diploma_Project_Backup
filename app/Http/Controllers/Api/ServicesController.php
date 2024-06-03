<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Traits\ApiResponserTrait;

class ServicesController extends Controller
{
    use ApiResponserTrait;
    public function index()
    {
        $services = Service::all();
        return $this->successResponse(ServiceResource::collection($services)->toArray(request()), 'All available categories', 200);
    }
    public function show(Service $service)
    {
        if (!$service) {
            return $this->errorResponse('Service does not exist', [], 404);
        }
        return $this->successResponse(['service' => new ServiceResource($service)], 'This is the service you requested', 200);
    }
}