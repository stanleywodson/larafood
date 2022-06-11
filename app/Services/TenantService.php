<?php
namespace App\Services;
use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TenantService
{
    private $plan, $data = [];

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
            'url'   =>  Str::kebab($this->data['empresa']), 
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