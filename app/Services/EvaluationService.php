<?php

namespace App\Services;

use App\Respositories\Contracts\EvaluationRepositoryInterface;
use App\Respositories\Contracts\OrderRepositoryInterface;

class EvaluationService
{
    protected $evaluationRepository;
    protected $orderRepository;

    public function __construct(EvaluationRepositoryInterface $evaluationInterface, OrderRepositoryInterface $orderInterface)
    {
        $this->evaluationRepository = $evaluationInterface;
        $this->orderRepository = $orderInterface;
    }

    public function CreateNewEvaluationOrder(string $orderIdentify)
    {
        $clientId = $this->getClientId();
        $order = $this->orderRepository->getOrderByIdentify($orderIdentify);
        return $this->evaluationRepository->newEvaluationOrder($order, $clientId);
    }

    private function getClientId()
    {
        return auth()->user()->id;
    }
}
