<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\termek;
use Faker\Generator as Faker;

$factory->define(termek::class, function (Faker $faker) {

    return [
        'nev' => $faker->word,
        'cikkszam' => $faker->word,
        'me' => $faker->randomDigitNotNull,
        'tsz' => $faker->randomDigitNotNull,
        'megjegyzes' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
