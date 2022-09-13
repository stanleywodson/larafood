<?php

namespace App\Respositories;

use App\Models\Client;
use App\Respositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class ClientRepository implements ClientRepositoryInterface
{
    protected $entity;

    public function __construct(Client $client)
    {
        $this->entity = $client;
    }

    public function createNewClient(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {
        return $this->entity->find($id);
    }
}
