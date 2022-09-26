<?php

namespace App\Respositories\Contracts;

interface OrderRepositoryInterface
{
    public function createNewOrder(string $identify, float $total, string $status, int $tenantId, $client = '', $tableId = '');

    public function getOrderByIdentify(string $identify);
}
