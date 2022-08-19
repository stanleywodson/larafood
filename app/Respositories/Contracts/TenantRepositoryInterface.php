<?php

namespace App\Respositories\Contracts;

interface TenantRepositoryInterface
{
    //vai ser definida a assinatura de todos os metódos que a interface deve ter.
    //quem assinar essa interface deverá possuir todos esses metódos.

    public function getAllTenants(int $per_page);
    public function getTenantByUuid(string $uuid);
}
