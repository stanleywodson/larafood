<?php

namespace App\Respositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(string $identify, float $total, string $status, int $tenantId,string $comment = '', $clientId = '', $tableId = '',$productsOrder);

    public function getOrderByIdentify(string $identify);
}
