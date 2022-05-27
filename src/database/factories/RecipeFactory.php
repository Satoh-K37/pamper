<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
      'recipe_title' => $faker->text(50),
      'content' => $faker->text(500),
      'serving' => $faker->randomDigit(5),
      'cooking_time' => $faker->randomDigit(5),
      'user_id' => function() {
          return factory(User::class);
      }
    ];
});
