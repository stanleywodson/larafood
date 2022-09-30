<?php

namespace App\Respositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(string $identify, float $total, string $status, int $tenantId,string $comment = '', $clientId = '', $tableId = '');

    public function getOrderByIdentify(string $identify);

    public function registerProductsOrder(int $orderId, array $products);

    public function myOrders(int $clientId);
}
