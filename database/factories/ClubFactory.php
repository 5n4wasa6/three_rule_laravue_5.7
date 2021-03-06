<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Models\Club::class, function (Faker $faker) {
    
    $fileRealPath = UploadedFile::fake()->create('tempfilename.pdf', 10);
    
    return [
        'user_id'        => $faker->numberBetween(1, 10),
        // 'official'       => $faker->numberBetween(0, 1),
        'school_name'    => $faker->realText(10),
        'school_calling' => $faker->randomElement(['高校', '中学']),
        'club_name'      => $faker->realText(10),
        'club_calling'   => $faker->randomElement(['部', 'クラブ', 'サークル', '同好会']),
        'image'          => $fileRealPath,
        // 'policy'         => $faker->realText(10),
        'rule_one'       => $faker->realText(10),
        'rule_two'       => $faker->realText(10),
        'rule_three'     => $faker->realText(10),
        'tag_one'        => $faker->realText(10),
        'tag_two'        => $faker->realText(10),
        'tag_three'      => $faker->realText(10),
        'tag_four'       => $faker->realText(10),
        'tag_five'       => $faker->realText(10)
    ];
});
