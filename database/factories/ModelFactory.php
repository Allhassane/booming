<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Annonce::class, function (Faker\Generator $faker) {

    $firstname = $faker->firstName;
    $lastname = $faker->lastName;

    $slug = \App\Annonce::createSlug($firstname.' '.$lastname).'-'.str_replace(':', '', date('H:i:s'));

    return [
        'name' => $firstname.' '.$lastname,
        'situation' => $faker->streetName,
        'description' => $faker->paragraph(3),
        'strong_point' => $faker->word.','.$faker->word.','.$faker->word.','.$faker->word.','.$faker->word.','.$faker->word.','.$faker->word,
        'city' => $faker->city,
        'mobile' => $faker->unique()->phoneNumber,
        'fixe' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->companyEmail,
        'categorie_id' => $faker->numberBetween(1,6),
        'promoted' => 0,
        'verified' => $faker->numberBetween(0,1),
        'statut' => $faker->numberBetween(0,1),
        'user_id' => 14,
        'slug' => $slug,
        'vignette' => $faker->randomElement(['1.png','2.png','3.png','4.png','5.png','6.png','7.png','8.png','9.png','10.png']),
    ];
});
