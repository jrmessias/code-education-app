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

$factory->define(JrMessias\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(JrMessias\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence
    ];
});

$factory->define(JrMessias\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1,5),
        'client_id' => rand(1,5),
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'progress' => rand(1,100),
        'status' => rand(0,1)
    ];
});

$factory->define(JrMessias\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'title' => $faker->word,
        'note' => $faker->paragraph
    ];
});

$factory->define(JrMessias\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'name' => $faker->word,
        'start_date' => $faker->date(),
        'due_date' => $faker->date(),
        'status' => rand(0,1)
    ];
});

