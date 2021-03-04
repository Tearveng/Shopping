@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        {{ isset($option)? 'Edit Option': 'Create Option' }}
    </div>

    <div class="card-body">

        @include('partial.errors')

        <form action="{{ isset($option)? route('options.update', $option->id): route('options.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(isset($option))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Option Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ isset($option)? $option->name: '' }}">
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Submit</button>
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