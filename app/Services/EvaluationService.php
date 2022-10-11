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

    public function CreateNewEvaluationOrder(string $identifyOrder, array $evaluation)
    {
        $clientId = $this->getClientId();
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder, $clientId);


        return $this->evaluationRepository->newEvaluationOrder($clientId, $order->id, $evaluation);
    }

    private function getClientId()
    {
        return auth()->user()->id;
    }
}
