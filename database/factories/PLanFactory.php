<?
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use Faker\Generator as Faker;

$factory->define(Plan::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
	    'description' => $faker->sentence,
        'price' => $faker->randomDigit,
    ];
});
