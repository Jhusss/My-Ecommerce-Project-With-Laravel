<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'name' => (['XS44 Extra Small', 'S55 Small', 'M66 Medium', 'L77 Large'])
    ];
});
