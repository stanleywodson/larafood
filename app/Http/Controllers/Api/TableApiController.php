<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TableResource;
use App\Services\TableService;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
    protected $tableService;

    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
    }

    public function getTablesByTenantUuid(TenantFormRequest $request)
    {
        $tables =  $this->tableService->getTablesByTenantUuid($request->token_company);
        return TableResource::collection($tables); // aqui usa se collection pq e um objeto
    }

    public function show($identity, TenantFormRequest $request)
    {
        if (!$table = $this->tableService->getTableByUuid($identity, $request->token_company))
            return response()->json(['message' => 'Table not found'], 404);

        return new TableResource($table); // aqui usa se o new pq vem somente um resultado
    }
}
