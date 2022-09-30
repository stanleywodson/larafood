<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $service)
    {
        $this->orderService = $service;
    }

    public function show($identify)
    {
            if (!$order = $this->orderService->getOrderByIdentify($identify))
                return response()->json(['message' => 'Order not found'], 404);


        return OrderResource::collection($order);
    }

    public function getOrdersFromClient()
    {
        $orders = $this->orderService->getOrdersFromClient();
        return OrderResource::collection($orders);
    }

    public function store(StoreOrder $request)
    {
        $order = $this->orderService->createNewOrder($request->all());
        return new OrderResource($order);
    }
}
