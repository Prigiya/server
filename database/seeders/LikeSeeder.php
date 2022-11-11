<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Likepost;

class LikeSeeder extends Seeder
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
            $likes = new Likepost();
            $likes->likes = $faker->randomElement([
                '0',
                '1',
            ]);
            $likes->post_id = $faker->randomElement([
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
            $likes->user_id = $faker->randomElement([
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
            $likes->save();
        }
    }
}
