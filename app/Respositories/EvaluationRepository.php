<?php

namespace App\Respositories;

use App\Models\Evaluation;
use App\Respositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }

    public function newEvaluationOrder(int $orderId, int $clientId)
    {
        // TODO: Implement newEvaluationOrder() method.
    }

    public function getEvaluationByOrder(int $orderId)
    {
        // TODO: Implement getEvaluationByOrder() method.
    }

    public function getEvaluationByClient(int $orderClient)
    {
        // TODO: Implement getEvaluationbyClient() method.
    }
}
