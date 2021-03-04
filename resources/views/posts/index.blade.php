@extends('layouts.app')

@section('content')


<div class="card card-default">
    <div class="card-header">
        <div class="d-flex justify-content-between">
            Posts
            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm">Add Posts</a>
        </div>
    </div>
    @if(count($posts) > 0)

    <div class="card-body">
        <table class="table">
            <thead>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Category</th>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$post->image) }}" width="120px" height="60px" alt="">
                    </td>
                    <td>{{ $post->title }}</td>

                    <td>
                        {{ $post->price }}$
                    </td>

                    <td>
                        <a href="{{ route('categories.edit', $post->catagory->id) }}">
                            {{ $post->catagory->name }}
                        </a>
                    </td>

                    @if(!$post->trashed())
                    <td>
                        <a href="{{ route('posts.edit', $post->id) }}">
                            <button class="btn btn-info btn-sm">Edit</button>
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('albums.create', $post->id) }}">
                            <button class="btn btn-primary btn-sm">RR</button>
                        </a>
                    </td>
                    @else
                    <td>
                        <form action="{{ route('restore.posts', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button class="btn btn-info btn-sm" type="submit">Restore</button>

                        </form>
                    </td>
                    @endif

                    <td>

                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                {{ $post->trashed() ? 'Delete': 'Trash' }}
                            </button>
                        </form>

                    </td>

                    <!-- <td>
                                <a href="{{ route('posts.show', $post->id) }}">
                                    <button class="btn btn-success">show</button>
                                </a>
                            </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card-body text-center">
        <h3>No Posts</h3>
    </div>
    @endif
</div>
@endsection