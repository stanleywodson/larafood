<?php

namespace App\Respositories\Contracts;

interface ClientRepositoryInterface
{
    public function createNewClient(array $data);

    public function getClient(int $id);

}
