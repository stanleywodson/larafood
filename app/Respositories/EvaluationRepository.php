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

    public function newEvaluationOrder(int $clientId, int $orderId, array $evaluation)
    {
        $data = [

            'stars' => $evaluation['stars'],
            'client_id' => $clientId,
            'order_id' => $orderId,
            'comments' => isset($evaluation['comments']) ? $evaluation['comments'] : ''
        ];

        return $this->entity->create($data);
    }

    public function getEvaluationByOrder(int $orderId)
    {
        return $this->entity->where('order_id', $orderId)->get();
    }

    public function getEvaluationByClient(int $clientId)
    {
        return $this->entity->where('client_id', $clientId)->get();
    }

    public function getEvaluationById(int $id)
    {
        return $this->entity->find($id);
    }

    public function getEvaluationByClientIdByOrderId(int $clientId, int $orderId)
    {
        return $this->entity
                ->where('client_id', $clientId)
                ->where('order_id', $orderId)
                ->first();
    }

}
