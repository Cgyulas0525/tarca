<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Utalvany;
use Faker\Generator as Faker;

$factory->define(Utalvany::class, function (Faker $faker) {

    return [
        'sorszam' => $faker->word,
        'osszeg' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
