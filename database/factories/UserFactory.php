<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(App\Models\User::class, function (Faker $faker) {

    return [
        'user_name' => $faker->name.'_user',
        'name' => $faker->name ,
        'password' => bcrypt('admin'),
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->email,
        'role' => 1,
        'user_id' => 1
    ];
});
$factory->define(App\Models\Complaint::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->name,
        'complaint' => $faker->sentence,

    ];
});

$factory->define(App\Models\Complaint::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->name,
        'complaint' => $faker->sentence,
        
    ];
});

$factory->define(App\Models\Inquiry::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' =>  $faker->regexify('09[0-9]{9}') ,
        'address' => $faker->sentence,
        'product_id' => rand(1,49)
    ];
});

$factory->define(App\Models\Brand::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' =>  "brandDefault.jpg" ,
        

    ];
});

$factory->define(App\Models\Module::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'brand_id' =>  rand(1,9) ,
    ];
});

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'en_name'=> $faker->name,
        'image'=> "product.jpg",
        'price'=> rand(10000,20000),
        'color'=> $faker->name,
        'description'=>$faker->text,
        'type'=> $faker->name,
        'capacity'=> $faker->name,
        'control'=> $faker->name,
        'technology'=> $faker->name,
        'micanthim'=> $faker->name,
        'shape'=> $faker->name,
        'characteristic'=> $faker->name,
        'guarantee'=> $faker->name
    ];
});

$factory->define(App\Models\Offer::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'image' => "offer.jpg",
        'price' => rand(10000,20000),
        'discount'=>rand(1,99),
        'product_id' =>  rand(1,9) ,
    ];
});


$factory->define(App\Models\Article::class, function (Faker $faker) {

    return [
        'title' => $faker->name,
        'en_title' => $faker->name,
        'description' => $faker->text ,
        'en_description' => $faker->text ,
        'user_id' =>1 ,
    ];
});  
$factory->define(App\Models\Team::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'postion' => $faker->name,
    ];
});

$factory->define(App\Models\Course::class, function (Faker $faker) {

    return [
        'title' => $faker->name,
        'en_title' => $faker->name,
        'description' => $faker->text ,
        'user_id' =>1 ,
    ];
});  

$factory->define(App\Models\Department::class, function (Faker $faker) {

    return [
        'title' => $faker->name,
        'en_title' => $faker->name,
        'description' => $faker->text ,
        'user_id' =>1 ,
    ];
});  

$factory->define(App\Models\Event::class, function (Faker $faker) {

    return [
        'title' => $faker->name,
        'description' => $faker->text ,
        'user_id' =>1 ,
    ];
});  