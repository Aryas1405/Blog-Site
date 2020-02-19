
<?php


use App\Category;
use Faker\Generator as Faker;
$factory->define(Category::class, function (Faker $faker) {
    return [
        
        'name' => $faker->word,
        'slug' => Str::slug($faker->unique()->sentence,'-'),
        'description' => $faker->paragraph,
    ];
});