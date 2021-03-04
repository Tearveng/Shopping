@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{ route('albums.create') }}" class="btn btn-success mb-2">Add Album</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>

    @foreach($posts->album->photos as $post)
    <h4>{{ $post->image }}</h4>
    @endforeach
</div>
@endsection