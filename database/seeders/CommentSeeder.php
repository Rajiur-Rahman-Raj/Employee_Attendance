<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Carbon\Carbon;
class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 1,
            'comments'   => 'admin first comment his own post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 1,
            'comments'   => 'admin second comment his own post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 2,
            'comments'   => 'admin third comment his own post (post number two)',
            'created_at' => Carbon::now(),  
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 1,
            'comments'   => 'Raju first comment admin post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 1,
            'comments'   => 'Raju second comment admin post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 1,
            'comments'   => 'Raju third comment admin post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 3,
            'post_id'    => 1,
            'comments'   => 'Tareq first comment admin post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 2,
            'comments'   => 'Raju first comment admin post (post number two)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 3,
            'comments'   => 'Raju first comment admin post (post number three)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 3,
            'comments'   => 'Raju second comment admin post (post number three)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 3,
            'post_id'    => 3,
            'comments'   => 'tareq first comment admin post (post number one)', 
            'created_at' => Carbon::now(), 
        ]);


        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 4,
            'comments'   => 'admin first comment Raju post (post number four)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 4,
            'comments'   => 'admin second comment Raju post (post number four)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 3,
            'post_id'    => 5,
            'comments'   => 'tareq first comment Raju post (post number five)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 3,
            'post_id'    => 5,
            'comments'   => 'tareq second comment Raju post (post number five)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 1,
            'post_id'    => 6,
            'comments'   => 'admin first comment Tareq post (post number six)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 6,
            'comments'   => 'Raju first comment Tareq post (post number six)', 
            'created_at' => Carbon::now(), 
        ]);

        return Comment::create([
            'user_id'    => 2,
            'post_id'    => 6,
            'comments'   => 'Raju second comment Tareq post (post number six)',
            'created_at' => Carbon::now(), 
        ]);
    }
}
