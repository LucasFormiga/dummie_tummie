<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

function big_rand( $len = 9 ) {
    $rand   = '';
    while( !( isset( $rand[$len-1] ) ) ) {
        $rand   .= mt_rand( );
    }
    return substr( $rand , 0 , $len );
}

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'phone' => big_rand(13),
        'sex' => mt_rand(0, 2),
        'cpf' => big_rand(11),
        'email_verified_at' => now(),
        'password' => bcrypt('123'),
        'remember_token' => Str::random(10),
    ];
});
