<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Services\EvaluationService;
use Illuminate\Http\Request;

class EvaluationApiController extends Controller
{
    protected $evaluationService;

    public function __construct(EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }

    public function store(StoreEvaluation $request)
    {
        $evaluationOrder = $request->only('stars', 'comments');

        if(!$evaluation =  $this->evaluationService->CreateNewEvaluationOrder($request->identifyOrder, $evaluationOrder)){
            return response()->json(['message' => 'error'], 404);
        }

        return new EvaluationResource($evaluation);

    }
}
