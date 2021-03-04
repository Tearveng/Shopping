<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\Photo\AddPhotoRequest;
use App\Http\Requests\Photo\UpdatePhotoRequest;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('photo.index')->with('photos', Photo::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_photo(Album $album)
    {
        return view('photo.create')->with('album', $album);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPhotoRequest $request)
    {
        $image = $request->image->store('photos')->fit(1200,1200);

        Photo::create([
            'image' => $image,
            'description' => $request->description,
            'album_id' => $request->album_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        return view('photo.create')->with('photo', $photo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $data = $request->only(['description']);

        if($request->hasFile('image'))
        {
            $image = $request->image->store('photos');

            Storage::delete($photo->image);

            $data['image'] = $image;
        }

        $photo->update($data);

        return redirect(route('photos.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();

        return redirect(route('photos.index'));
    }
}
