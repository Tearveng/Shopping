@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{ route('albums.create') }}" class="btn btn-success mb-2">Add Album</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Album_Id</th>
                <th style="margin-left: -10px;">Image</th>
                <th>Album_Code</th>
                <th>Photo</th>

            </thead>
            <tbody>
                @foreach($albums as $album)
                <tr>
                    <td>
                        <strong class="ml-4">{{ $album->id }}</strong>
                    </td>

                    <td>
                        <img src="{{ asset('storage/'.$album->image) }}" width="120px" height="60px" alt="">
                    </td>

                    <td>
                        {{ $album->album_code }}
                    </td>

                    <td>
                        <a href="{{ route('photos.create', $album->id) }}">
                            <button class="btn btn-primary btn-sm">Create</button>
                        </a>


                    </td>
                    <td>
                        <a href="{{ route('photos.index') }}">
                            <button class="btn btn-warning btn-sm">View</button>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('albums.edit', $album->id) }}">
                            <button class="btn btn-info btn-sm">Edit</button>
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('albums.destroy', $album->id) }}" method="POST">
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
@endsection