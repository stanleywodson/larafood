<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{
    private TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);

        return TenantResource::collection($this->tenantService->getAllTenants($per_page));
    }

    public function show($uuid)
    {
        if (!$tenant = $this->tenantService->getTenantByUuid($uuid))
            return response()->json(['message' => 'Not found'], 404);

        return new TenantResource($tenant);
    }
}
