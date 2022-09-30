<?php

namespace App\Services;

use App\Respositories\Contracts\OrderRepositoryInterface;
use App\Respositories\Contracts\ProductRepositoryInterface;
use App\Respositories\Contracts\TableRepositoryInterface;
use App\Respositories\Contracts\TenantRepositoryInterface;

class OrderService
{
    protected $orderRepository, $tenantRepository, $tableRepository, $productRepository;


    public function __construct(
        OrderRepositoryInterface $orderInterface,
        TenantRepositoryInterface $tenantInterface,
        TableRepositoryInterface $tableInterface,
        ProductRepositoryInterface $productInterface
    )

    {
        $this->orderRepository = $orderInterface;
        $this->tenantRepository = $tenantInterface;
        $this->tableRepository = $tableInterface;
        $this->productRepository = $productInterface;
    }

    public function createNewOrder(array $order)
    {
        $productsOrder = $this->getProductsByOrder($order['products'] ?? []);
        $total = $this->getTotalOrder($productsOrder);
        $identify = $this->getIdentifyOrder();
        $status = 'open';
        $tenantid = $this->getTenantIdOrder($order['token_company']);
        //$comment = $order['comment'];
        $comment = isset($order['comment'])? $order['comment'] : '';
        $clientId = $this->getClientIdOrder();
        $tableId = $this->getTableOrder($order['table'] ?? '');

        $order = $this->orderRepository->createNewOrder($identify, $total, $status, $tenantid, $comment, $clientId, $tableId);

        $this->orderRepository->registerProductsOrder($order->id, $productsOrder);

        return $order;


    }

    private function getIdentifyOrder(int $qtyCaracters = 8)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstwxyz');
        $numbers = (((date('Ymd')/ 12) +24) + mt_rand(800, 9999));
        $numbers .= 123456789;

        $characters = $smallLetters.$numbers;

        $identify = substr(str_shuffle($characters), 0, $qtyCaracters);

//        if ($this->orderRepository->getOrderByIdentify($identify)){
//            $identify = $this->getIdentifyOrder($qtyCaracters + 1);
//        }

        return $identify;
    }

    public function getOrdersFromClient()
    {
        $clientId = $this->getClientIdOrder();
        return $this->orderRepository->myOrders($clientId);


    }

    private function getProductsByOrder(array $products): array
    {
        $productsOrder = [];
        foreach ($products as $product){
            $pro = $this->productRepository->getProductByUuid($product['identify']);

            array_push($productsOrder, [
                //'id'    => $pro->id,
                'product_id'    => $pro->id,
                'qty'   => $product['qty'],
                'price' => $pro->price
            ]);

        }
        return $productsOrder;
    }

    private function getTotalOrder(array $products): float
    {
        $total = 0;
        foreach ($products as $product){
            $total += ($product['price'] * $product['qty']);
        }
        return (float) $total;
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
