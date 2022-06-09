<?php

namespace Database\Seeders;

use App\Models\{Tenant, Plan};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj'=>12345678909876, 
            'name'=>'swsouza', 
            'url'=>'swsouza', 
            'email'=>'swsouza@swsouza',
        ]);
    }
}
