<?php

namespace App\Services;

use App\Respositories\Contracts\OrderRepositoryInterface;
use App\Respositories\Contracts\TableRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository;


    public function __construct(
        OrderRepositoryInterface $orderInterface,
        TenantRepositoryInterface $tenantInterface,
        TableRepositoryInterface $tableInterface
    )

    {
        $this->orderRepository = $orderInterface;
        $this->tenantRepository = $tenantInterface;
        $this->tableRepository = $tableInterface;
    }

    public function createNewOrder(array $order)
    {
        $identify = $this->getIdentifyOrder();
        $total = $this->getTotalOrder([]);
        $status = 'open';
        $tenantid = $this->getTenantIdOrder($order['token_company']);
        //$comment = $order['comment'];
        $comment = isset($order['comment'])? $order['comment'] : '';
        $clientId = $this->getClientIdOrder();
        $tableId = $this->getTableOrder($order['table'] ?? '');

        return $order = $this->orderRepository->createNewOrder($identify, $total, $status, $tenantid, $comment, $clientId, $tableId);

    }

    private function getIdentifyOrder(int $qtyCaracters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstwxyz');
        $numbers = (((date('Ymd')/ 12) +24) + mt_rand(800, 9999));
        $numbers .= 123456789;

        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaracters);

        if ($this->orderRepository->getOrderByIdentify($identify)){
            $identify = $this->getIdentifyOrder($qtyCaracters + 1);
        }

        return $identify;
    }

    private function getTotalOrder(array $products): float
    {
        return (float) 90;
    }

    private function getTenantIdOrder(string $uuid)
    {
        $tenant =  $this->tenantRepository->getTenantByUuid($uuid);
        return $tenant->id;
    }

    private function getTableOrder(string $uuid = '')
    {
        if ($uuid){
            $table = $this->tableRepository->getTableByUuid($uuid);
            return $table->id;
        }

        return '';

    }

    private function getClientIdOrder()
    {
        return auth()->check() ? auth()->user()->id : '';
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->orderRepository->getOrderByIdentify($identify);
    }

}
