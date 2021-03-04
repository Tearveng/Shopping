<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\Album\AddAlbumsRequest;
use App\Http\Requests\Album\UpdateAlbumRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;


class AlbumsController extends Controller
{



    public function index()
    {
        return view('album.index')->with('albums', Album::all());
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(AddAlbumsRequest $request)
    {
        $image = $request->image->store('albums');

        $album = Album::create([
            'image' => $image,
            'album_code' => $request->album_code
        ]);

        if ($request->post_id) {
            $album->posts->attach($request->post_id);
        }

        return redirect()->back();
    }

    public function show(Album $album)
    {
        return view('album.show')->with('albums', $album);
    }

    public function edit(Album $album)
    {
        return view('album.create')->with('album', $album);
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $data = $request->only('album_code');

        if ($request->hasFile('image')) {
            $image = $request->image->store('albums');

            Storage::delete($album->image);

            $data['image'] = $image;
        }

        $album->update($data);

        session()->flash('success', 'Album updated successfully');

        return redirect(route('albums.index'));
    }

    public function destroy(Album $album)
    {
        $post = Post::find($album->id);

        if ($album->id == $post->album_id) {
            session()->flash('error', 'Album cannot be deleted because it has a post');

            return redirect()->back();
        }


        // $album->delete();

        // return redirect()->back();
    }
}
