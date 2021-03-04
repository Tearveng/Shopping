<?php

namespace App\Http\Controllers;

use App\Album;
use App\Catagory;
use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Option;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')
                ->with('categories', Catagory::all())
                ->with('tags', Tag::all())
                ->with('albums', Album::all())
                ->with('options', Option::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        
        
        $image = ($request->image->store('posts'));

        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'publish_at'=>$request->publish_at,
            'catagory_id'=>$request->catagory,
            'user_id'=>auth()->user()->id,
            'price'=>$request->price,
            'album_id' =>$request->album_id
        ]);

        if($request->options)
        {
            $post->options()->attach($request->options);
        }

        if($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('posts', $post)->with('album', Album::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')
                ->with('post',$post)
                ->with('categories', Catagory::all())
                ->with('tags', Tag::all())
                ->with('albums', Album::all())
                ->with('options', Option::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'publish_at', 'content', 'price']);

        if($request->hasFile('image')){

            $image = $request->image->store('posts');

            Storage::delete($post->image);

            $data['image'] = $image;

        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        if($request->options)
        {
            $post->options()->sync($request->options);
        }

        $post->update($data);


        session()->flash('success', 'Post updated successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail(); 

        if($post->trashed()){
            $post->forceDelete();
            Storage::delete($post->image);
            session()->flash('success', 'Post Deleted successfully');
        }else{
            $post->delete();
            session()->flash('success', 'Post trashed successfully');
        }

        

        return redirect(route('posts.index'));
    }

    /**
     * Trashed posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);

    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');

        return redirect(route('posts.index'));
    }
}
