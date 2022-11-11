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
        '19',
        '20',
        '3',
        '24',
        '25',
        '26',
        '7',
        '8',
        '9',
        '10',
        '11',
        '12',
        '13',
        '15',
        '14',
        '16',
        '17',
        '18',
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
