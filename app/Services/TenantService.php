<?php
namespace App\Services;
use App\Models\Plan;
use App\Respositories\Contracts\TenantRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    private $plan, $data = [];
    private $repository;

    //vai ser injetado um objeto do metódo contrato(interfaces nao podem ser implementadas aqui,
    //foi feito um bind no appserviceprovide da interface com a classe tenantrepository)
    public function __construct(TenantRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTenants()
    {
        return $this->repository->getAllTenants();
    }

    public function make(PLan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;

        $tenant = $this->storeTenant();
        $user = $this->storeUser($tenant);

        return $user;
    }

    public function storeTenant()
    {
       return $this->plan->tenants()->create([
            'cnpj'  =>  $this->data['cnpj'],
            'name'  =>  $this->data['empresa'],
            'email' =>  $this->data['email'],
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
    }

    public function storeUser($tenant)
    {
        $user = $tenant->users()->create([
            'name'     => $this->data['name'],
            'email'    => $this->data['email'],
            'password' => Hash::make($this->data['password']), // password
        ]);

        return $user;
    }
}
