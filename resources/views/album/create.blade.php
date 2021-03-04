@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($album)? 'Edit Album': 'Create Album' }}
    </div>

    <div class="card-body">

        @include('partial.errors')

        <form action="{{ isset($album)? route('albums.update', $album->id):route('albums.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($album))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="">Album_Code</label>
                <input type="text" class="form-control" name="album_code" id="album_id" value="{{ isset($album)? $album->album_code: '' }}">
            </div>

            @if(isset($album))
            <div class="form-group">
                <img src="{{ asset('storage/'.$album->image) }}" alt="" style="width: 100%;">
            </div>
            @endif

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>

            <div class="form-group">
                <button class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    flatpickr('#publish_at', {
        enableTime: true,
        enableSeconds: true
    })

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
@endsection