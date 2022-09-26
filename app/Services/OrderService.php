<?php

namespace App\Services;

use App\Respositories\Contracts\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderInterface)
    {
        $this->orderRepository = $orderInterface;
    }

    public function createNewOrder(array $order)
    {
        return $this->orderRepository->createNewOrder($order);
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }
}
