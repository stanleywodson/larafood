<?php

namespace App\Services;

use App\Respositories\Contracts\ClientRepositoryInterface;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepositoryInterface $clientInterface)
    {
        $this->clientRepository = $clientInterface;
    }

    public function createNewClient(array $data)
    {
        return $this->clientRepository->createNewClient($data);
    }

    public function getClient(int $id)
    {
        return $this->clientRepository->getClient($id);
    }
}
