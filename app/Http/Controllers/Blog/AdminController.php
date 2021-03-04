<?php

namespace App\Http\Controllers\Blog;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() 
    {
        return view('carts.home')->with('carts', Cart::all());
    }   
}
