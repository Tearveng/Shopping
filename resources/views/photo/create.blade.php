@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($photo)? 'Edit Photo':'Create Photo' }}
    </div>

    <div class="card-body">

        @include('partial.errors')

        <form action="{{ isset($photo)? route('photos.update', $photo->id):route('photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($photo))
            @method('PUT')
            @endif

            @if(isset($album))
            <input type="hidden" name="album_id" id="album_id" value="{{ $album->id }}">
            @endif

            @if(isset($photo))
            <div class="form-group">
                <img src="{{ asset('storage/'.$photo->image) }}" alt="" style="width: 100%;">
            </div>
            @endif

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" type="hidden" name="description" value="{{ isset($photo)? $photo->description: '' }}">
                <trix-editor input="description"></trix-editor>
            </div>



            <div class="form-group">
                <button class="btn btn-success" type="submit">{{ isset($photo)? 'Update': 'Submit' }}</button>
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