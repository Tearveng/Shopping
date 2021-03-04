<?php

use App\Album;
use App\Catagory;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Catagory::create([
            'name' => 'News',
        ]);

        $category2 = Catagory::create([
            'name' => 'Design',
        ]);

        $category3 = Catagory::create([
            'name' => 'Partnership',
        ]);

        $category4 = Catagory::create([
            'name' => 'Hiring',
        ]);

        $user1 = User::create([
            'name' => 'Mr.one',
            'email' => 'mrone@gmail.com',
            'password'=> Hash::make('password')
        ]);

        $user2 = User::create([
            'name' => 'Mr.two',
            'email' => 'mrtwo@gmail.com',
            'password'=> Hash::make('password')
        ]);

        $user3 = User::create([
            'name' => 'Mr.three',
            'email' => 'mrthree@gmail.com',
            'password'=> Hash::make('password')
        ]);

        $user4 = User::create([
            'name' => 'Mr.four',
            'email' => 'mrfour@gmail.com',
            'password'=> Hash::make('password')
        ]);

        $album1 = Album::create([
            'album_code' => 'AA005',
            'image' => 'albums/5pRQCNasBGaLMuiCXx9DBvKpihwXCj9exZTlqGkA.jpg',
        ]);

        $album2 = Album::create([
            'album_code' => 'AA006',
            'image' => 'albums/A6TtrFd0AlODkFsEZshIgYv5cXnOIrxAciKgr3ye.jpg',
        ]);

        $album3 = Album::create([
            'album_code' => 'AA007',
            'image' => 'albums/DaFDAuGoWc5jeUVfGse3uRG3j2hqaLdlPdGEEja3.jpg',
        ]);

        $album4 = Album::create([
            'album_code' => 'AA008',
            'image' => 'albums/htXHrSTmWBcvsinfeFWNVXu0A2K3YpJ0hdefMwC8.jpg',
        ]);

        $post1 = $user1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Make sure to place composers system-wide vendor bin directory in your so the laravel executable can be located by your system. This directory exists in different locations based your operating system; however, some common locations include:',
            'content' => 'Make sure to place composers system-wide vendor bin directory in yo',
            'catagory_id'=> $category1->id,
            'image' => 'posts/14.jpg',
            'price' => 200,
            'album_id' => $album1->id
        ]);

        $post2 = Post::create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory ',
            'content' => 'Make sure to place composers system-wide vendor bin directory',
            'catagory_id' => $category2->id,
            'image' => 'posts/16.jpg',
            'user_id'=> $user2->id,
            'price' => 500,
            'album_id' => $album2->id
        ]);

        $post3 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory ',
            'content' => 'Make sure to place composers system-wide vendor bin directory',
            'catagory_id' => $category3->id,
            'image' => 'posts/17.jpg',
            'user_id'=> $user3->id,
            'price' => 100,
            'album_id' => $album3->id
        ]);

        $post4 = Post::create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory Make sure to place composers system-wide vendor bin directory ',
            'content' => 'Make sure to place composers system-wide vendor bin directory',
            'catagory_id' => $category4->id,
            'image' => 'posts/12.jpg',
            'user_id'=> $user4->id,
            'price' => 1000,
            'album_id' => $album4->id
        ]);

        $tag1 = Tag::create([
            'name' => 'Records'
        ]);

        $tag2 = Tag::create([
            'name' => 'Progress'
        ]);

        $tag3 = Tag::create([
            'name' => 'Customer'
        ]);

        $tag4 = Tag::create([
            'name' => 'Offer'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);

        $post2->tags()->attach([$tag2->id, $tag4->id]);

        $post3->tags()->attach([$tag4->id, $tag3->id]);

        $post4->tags()->attach([$tag3->id, $tag1->id]);
    }
}
