<?php

namespace App\Models\Traits;


use App\Models\Cargo;
use App\Models\Permission;
use App\Models\Tenant;

trait UserACLTrait
{
    public function permissions()
    {
        $permissionsPlan = $this->permissionPlan();
        $permissionCargo = $this->permissionCargo();

        $permissions = [];

        foreach ($permissionCargo as $permission) {
            if (in_array($permission, $permissionsPlan)) {
                array_push($permissions, $permission);
            }
        }

        return $permissions;
    }
    public function permissionPlan()
    {
        //        $tenant = $this->tenant()->first();
        //        $plan =  $tenant->plan;
        $tenant = Tenant::with('plan.profiles.permissions')->where('id', $this->tenant_id)->first();
        $plan = $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile) {
            foreach ($profile->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }

    public function permissionCargo(): array
    {
        $cargos = $this->cargos()->with('permissions')->get();

        $permissions = [];
        //ainda estou testando mas esse foreach funciona usando o first();
        //        foreach ($cargos->permissions as $permission){
        //            array_push($permissions, $permission->name);
        //        }
        foreach ($cargos as $cargo) {
            foreach ($cargo->permissions as $permission) {
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;
    }
    //verifica se tal user tem uma determinada permissão
    public function hasPermission(string $permissionName): bool
    {
        return in_array($permissionName, $this->permissions());
    }
    //verifica se e admin
    public function isAdmin(): bool
    {
        //essa trait e uma continuação de model user ou onde ela for usada, por isso
        // vai comparar o email com o array que foi criado em config -> tenant
        return in_array($this->email, config('tenant.admins')); //reaproveitando
    }
    //confirma que nao e admin
    public function isTenant(): bool
    {
        return !in_array($this->email, config('tenant.admins'));
    }
}
