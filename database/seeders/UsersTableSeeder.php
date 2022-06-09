<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->users->create([
            'company_id' => $tenant->id,
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make(123456), // password
        ]);
    }
}
