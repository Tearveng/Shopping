<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Catagory;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    
    public function index()
    {
        // $search = request()->query('search');
        // if($search){
        //     $search = Post::where('title', 'LIKE', "%{$search}%")->simplePaginate(1);
        // }else{
        //     $search = Post::simplePaginate(3);
        // }
        return view('welcome')
            ->with('categories', Catagory::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::searched()->simplePaginate(4))
            ->with('carts', (auth()->user())? auth()->user()->carts: Cart::all());
            ;
    }
}
