<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
class PlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        factory(Plan::class, 3)->create()->each(function($p) {
            $p->details()->saveMany(factory(DetailPlan::class, 6)->make());
            $p->companies()->saveMany(factory(Tenant::class, 4)->make());
          });
    }
}
