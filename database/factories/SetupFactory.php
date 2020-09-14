<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;


$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});

$factory->define(\App\Models\Employee::class, function (Faker $faker) {
    return [
        'name'=> $faker->name,
        'email'=> $faker->unique()->safeEmail
    ];
});

$factory->define(\App\Models\EmployeeInfo::class, function (Faker $faker) {
    return [
        'birthday' => $faker->date()
    ];
});

