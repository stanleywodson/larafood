<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Tenant::class, function (Faker $faker) {
    return [
        'cnpj'=> $faker->cnpj(false),
        'name' => $faker->company,
        'url' => $faker->url,
        'email' => $faker->unique()->safeEmail,
    ];
});