<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Post::create([
            'user_id'        => 1,
            'post_title'     => 'post one',
            'post_details'   => 'details one',
            'created_at'     => Carbon::now(),
        ]);

        Post::create([
            'user_id'        => 1,
            'post_title'     => 'post two',
            'post_details'   => 'details two',
            'created_at'     => Carbon::now(),
        ]);

        Post::create([
            'user_id'        => 1,
            'post_title'     => 'post three',
            'post_details'   => 'details three',
            'created_at'     => Carbon::now(),
        ]);

        Post::create([
            'user_id'        => 2,
            'post_title'     => 'post four',
            'post_details'   => 'details four',
            'created_at'     => Carbon::now(),
        ]);

        Post::create([
            'user_id'        => 2,
            'post_title'     => 'post five',
            'post_details'   => 'details five',
            'created_at'     => Carbon::now(),
        ]);

        Post::create([
            'user_id'        => 3,
            'post_title'     => 'post six',
            'post_details'   => 'details six',
            'created_at'     => Carbon::now(),
        ]);
    }
}
