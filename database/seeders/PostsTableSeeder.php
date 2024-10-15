<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::find(1);
        Post::truncate();
        $admin->posts()->saveMany([
        new Post([
            'title'=>'blog post 1',
            'slug'=>'blog-post-1',
            'excerpt'=>'blog post 1 excerpt',
            'body'=>'This is the first blog post',
        ]),
        new Post([
            'title'=>'blog post 2',
            'slug'=>'blog-post-2',
            'excerpt'=>'blog post 2 excerpt',
            'body'=>'This is the second blog post',
        ]),
        new Post([
            'title'=>'blog post 3',
            'slug'=>'blog-post-3',
            'excerpt'=>'blog post 3 excerpt',
            'body'=>'This is the third blog post',
        ]),
    ]);
    }
}
