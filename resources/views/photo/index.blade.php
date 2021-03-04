@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">

    <div class="card card-default w-100">
        <div class="card-header">
            Photo
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Album_Id</th>
                    <th>Image</th>
                    <th>Description</th>
                </thead>
                <tbody>
                    @foreach($photos as $photo)
                    <tr>
                        <td>
                            <strong class="ml-2"> {{ $photo->album->album_code }}</strong>
                        </td>

                        <td>
                            <img src="{{ asset('storage/'.$photo->image) }}" width="120px" height="60px" alt="">
                        </td>

                        <td>
                            {!! $photo->description !!}
                        </td>

                        <td>
                            <a href="">
                                <button class="btn btn-primary btn-sm mr">View</button>
                            </a>
                        </td>

                        <td>
                            <a href="{{ route('photos.edit', $photo->id) }}">
                                <button class="btn btn-warning btn-sm ">Edit</button>
                            </a>

                        </td>

                        <td>
                            <form action="{{ route('photos.destroy', $photo->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection