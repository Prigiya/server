<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Dislike;

class DislikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    $faker = Faker::create();
    for($i=1; $i<100; $i++){
    $dislikes = new Dislike();
    $dislikes->dislikes = $faker->randomElement([
        '0',
        '1',
    ]);
    $dislikes->post_id = $faker->randomElement([
            '1406',
            '1407',
            '1408',
            '1409',
            '1414',
            '1411',
            '1412',
            '1413',
            '1414',
            '1415',
            '1416',
            '1417',
            '1418',
            '1419',
            '1420',
            '1421',
            '1422',
            '1423',
    ]);
    $dislikes->user_id = $faker->randomElement([
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        '14',
    ]);
    $dislikes->save();
}
    }
}
