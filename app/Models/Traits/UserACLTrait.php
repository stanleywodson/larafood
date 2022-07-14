<?php
namespace App\Models\Traits;


trait UserACLTrait
{
    public function permissions()
    {
        $tenant = $this->tenant()->first();
        $plan =  $tenant->plan;

        $permissions = [];
        foreach ($plan->profiles as $profile){
            foreach ($profile->permissions as $permission){
                array_push($permissions, $permission->name);
            }
        }

        return $permissions;

    }
    //verifica se tal user tem uma determinada permissão
    public function hasPermission(string $permissionName):bool
    {
        return in_array($permissionName, $this->permissions());
    }

    public function isAdmin():bool
    {
        //essa trait e uma continuação de model user ou onde ela for usada por isso,
        // vai comparar o email com o array que foi criado em config -> tenant
        return in_array($this->email, config('tenant.admins')); //reaproveitando
    }

    public function isTenant():bool
    {
        return !in_array($this->email, config('tenant.admins'));
    }

}
