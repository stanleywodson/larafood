<?php

namespace App\Respositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $clientId, int $orderId, array $evaluation);

    public function getEvaluationByOrder(int $orderId);

    public function getEvaluationByClient(int $orderClient);

    public function getEvaluationById(int $id);

    public function getEvaluationByClientIdByOrderId(int $clientId, int $orderId);
}
