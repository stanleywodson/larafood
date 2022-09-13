<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreClient;
use App\Http\Resources\ClientResource;
use App\Services\ClientService;

class RegisterController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $service)
    {
        $this->clientService = $service;
    }

    public function store(StoreClient $request)
    {
        $client = $this->clientService->createNewClient($request->all());
        return new ClientResource($client);
    }

    public function getClient(int $id)
    {
        if (!$client = $this->clientService->getClient($id))
            return response()->json(['message' => 'User not found'], 404);

        return new ClientResource($client);
    }
}
