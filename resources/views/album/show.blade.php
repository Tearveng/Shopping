@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
    <a href="{{ route('albums.create') }}" class="btn btn-success mb-2">Add Album</a>
</div>

<div class="card card-default">
    <div class="card-header">
        Posts
    </div>

    @foreach($albums->photos as $album)
        <h4>{{ $album->id }}</h4>
    @endforeach
</div>
@endsection