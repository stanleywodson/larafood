<?php

namespace App\Respositories;

use App\Models\Order;
use App\Respositories\Contracts\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(string $identify, float $total, string $status, int $tenantId, $client = '', $tableId = '')
    {
        dd($identify,  $total, $status, $tenantId, $client = '', $tableId = '');

    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->get();
    }
}
