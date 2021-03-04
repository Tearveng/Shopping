<?php

namespace App\Http\Controllers\Blog;

use App\Album;
use App\Cart;
use App\Catagory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show')
                ->with('posts', $post)
                ->with('postalot', Post::all())
                ->with('categories', Catagory::all())
                ->with('carts', (auth()->user())? auth()->user()->carts: Cart::all());
    }

    public function category(Catagory $category)
    {
        // $search = request()->query('search');
        // if($search){
        //     $search = $category->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(1);
        // }else{
        //     $search = $category->posts()->simplePaginate(2);
        // }

        return view('blog.category')
            ->with('category', $category)
            ->with('posts', $category->posts()->searched()->simplePaginate(2))
            ->with('categories', Catagory::all())
            ->with('tags', Tag::all())
            ->with('carts', (auth()->user())? auth()->user()->carts: Cart::all());
    }

    public function tag(Tag $tag)
    {   
        // $search = request()->query('search');
        // if($search){
        //     $search = $tag->posts()->where('title', 'LIKE', "%{$search}%")->simplePaginate(1);
        // }else{
        //     $search = $tag->posts()->simplePaginate(2);
        // }

        return view('blog.tag')
            ->with('tag', $tag)
            ->with('posts', $tag->posts()->searched()->simplePaginate(2))
            ->with('categories', Catagory::all())
            ->with('tags', Tag::all())
            ->with('carts', (auth()->user())? auth()->user()->carts: Cart::all());
    }
}
