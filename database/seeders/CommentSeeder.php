<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
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
        $comment = new Comment();
        $comment->comment_post = $faker->randomElement([
            'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequatLorem ipsum dolor sit amet,',
            'eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo.pariaturSed ut perspiciatis?',
            'occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborumDuis aute irure dolor Excepteur sint.',
            'ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, iwejwi iulndhwuh omzjsa',
            'quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid sed quia non numquam eius modi autem vel',
        ]);
        $comment->post_id = $faker->randomElement([
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
        $comment->user_id = $faker->randomElement([
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
        $comment->save();
    }
}
}
