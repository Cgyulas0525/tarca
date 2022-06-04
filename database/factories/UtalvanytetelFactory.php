<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Utalvanytetel;
use Faker\Generator as Faker;

$factory->define(Utalvanytetel::class, function (Faker $faker) {

    return [
        'utalvany_id' => $faker->randomDigitNotNull,
        'osszeg' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
