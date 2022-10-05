<?php

namespace App\Respositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $orderId, int $clientId);

    public function getEvaluationByOrder(int $orderId);

    public function getEvaluationByClient(int $orderClient);
}
