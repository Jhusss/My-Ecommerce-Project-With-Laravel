<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => rtrim($faker->sentence(rand(5,8)), "."),
        'description' => $faker->paragraphs(rand(2,5), true),
        'category_id' => rand(1,4),
        'size_id' => rand(1,4),
        'quantity' => rand(3,20),
        'product_image' => 'placeholder.jpg',
        'price' => rand(10,50),
    ];
});
