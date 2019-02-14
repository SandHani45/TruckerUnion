<?php

use Faker\Generator as Faker;

$factory->define(App\Favorite::class, function (Faker $faker) {
    return [
      
        // 'user_id' => function () {
        //     return factory(App\User::class)->create()->id;
        // },
        // 'drop_point_id' => function () {
        //     return factory(App\DropPoint::class)->create()->id;
        // }
    ];
});
