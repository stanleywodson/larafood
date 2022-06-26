<?php

namespace App\Tenant;

use App\Models\Tenant;

class ManagerTenant
{
    public function getTenantIdentify()
    {
        return auth()->user()->tenant_id;
    }
    //retorna um objeto de tenant
    public function getTenant(): Tenant
    {
        return auth()->user()->tenant;
    }
    // verifica se o usuário autenticado tem permissão como super administrador
    public function isAdmin(): bool
    {
        return in_array(auth()->user()->email, config('tenant.admins'));
    }
}