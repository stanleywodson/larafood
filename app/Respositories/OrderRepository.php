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

    public function createNewOrder(string $identify, float $total, string $status, int $tenantId,string $comment = '', $clientId = '', $tableId = '', $productsOrder)
    {
        $data = [
            'tenant_id' => $tenantId,
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'comment' => $comment,
        ];

        //if ($comment){$data['comment'] = $comment;}
        if ($clientId){$data['client_id'] = $clientId;}
        if ($tableId){$data['table_id'] = $tableId;}

        if($order = $this->entity->create($data)){
                $teste = [];
                foreach ($productsOrder as $p){
                    array_push($teste, [
                        'product_id' => $p['id'],
                        'qty' => $p['qty'],
                        'price' => $p['price']
                    ]);

                    $teste2 = $order->products()->attach($teste);
                }
        }

        return $order;


    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->get();
    }
}
