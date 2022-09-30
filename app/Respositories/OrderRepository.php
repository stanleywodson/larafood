<?php

namespace App\Respositories;

use App\Models\Order;
use App\Respositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(Order $order)
    {
        $this->entity = $order;
    }

    public function createNewOrder(string $identify, float $total, string $status, int $tenantId,string $comment = '', $clientId = '', $tableId = '')
    {
        $data = [
            'tenant_id' => $tenantId,
            'identify'  => $identify,
            'total'     => $total,
            'status'    => $status,
            'comment'   => $comment,
        ];

        //if ($comment){$data['comment'] = $comment;}
        if ($clientId){$data['client_id'] = $clientId;}
        if ($tableId){$data['table_id'] = $tableId;}

//        if($order = $this->entity->create($data)){
//                $teste = [];
//                foreach ($productsOrder as $p){
//                    array_push($teste, [
//                        'product_id' => $p['id'],
//                        'qty' => $p['qty'],
//                        'price' => $p['price']
//                    ]);
//
//                    $teste2 = $order->products()->attach($teste);
//                }
//        }

        return $order = $this->entity->create($data);
    }

    public function registerProductsOrder(int $orderId, array $products)
    {
        //1ª MANEIRA
//        $orderProducts = [];
//        foreach ($products as $product){
//            array_push($orderProducts, [
//                'order_id'   => $orderId,
//                'product_id' => $product['id'],
//                'qty'        => $product['qty'],
//                'price'      => $product['price']
//            ]);
//
//            DB::table('order_product')->insert($orderProducts);
//        }

        //2ª MANEIRA
//        $order = $this->entity->find($orderId);
//        $productsOrder = collect($products);
//        dd($productsOrder);
//        $order->products()->attach($productsOrder);

        //3ª MANEIRA -- funcional
//        $order = $this->entity->find($orderId);
//        $productsOrder = collect($products)->map(function ($product){
//            $product['product_id'] = $product['id'];
//            unset($product['id']);
//            return $product;
//        });
//        $order->products()->attach($productsOrder);

        //4ª MANEIRA -- funcional
        $order = $this->entity->find($orderId);
        return $order->products()->sync($products);
    }

    public function myOrders(int $clientId)
    {
        return $this->entity->where('client_id', $clientId)->paginate(1);
    }


    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify', $identify)->get();
    }

}
