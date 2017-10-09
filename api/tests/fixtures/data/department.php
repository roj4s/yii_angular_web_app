<?php
namespace app\tests\fixtures;

$icons = [
    'accessibility'
];

$faker = \Faker\Factory::create();

$data = [];


for($i=0; $i<10; $i++){

    $word = "";

    do{
        $word = $faker->sentence(1);
    }
    while(in_array($word, array_keys($data)));

    $data[$word] = [

        'name' => $word,
        'icon_class' => $icons[random_int(0, count($icons) -1)]

    ];

}

return $data;