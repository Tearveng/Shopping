@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        <!-- {{ isset($album)? 'Edit Album': 'Create Album' }} -->
        <div class="d-flex justify-content-between">
            Options
            <a href="{{ route('options.create') }}" class="btn btn-success btn-sm">Add Option</a>
        </div>
    </div>

    @if(count($options) > 0)
    <div class="card-body">
        <table class="table">

            <thead>
                <th>Name</th>
                <th>Post Count</th>
            </thead>

            <tbody>
                @foreach($options as $option)

                <tr>

                    <td>{{ $option->name }}</td>

                    <td> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp {{ $option->posts->count() }}</td>

                    <td>
                        <a href="{{ route('options.edit', $option->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $option->id }})">Delete</button>
                    </td>

                </tr>

                @endforeach
            </tbody>

        </table>

        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="deleteCategoryForm">
                    @method('DELETE')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold">Are you sure you want to delete this category?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go Back</button>
                            <button type="submit" class="btn btn-primary">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="card-body text-center">
        <h3>No Options</h3>
    </div>
    @endif
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
        $('.options-selector').select2();
    });

    function handleDelete(id) {
        var form = document.getElementById('deleteCategoryForm');
        form.action = '/options/' + id;
        console.log('Deleting', form);
        $('#deleteModal').modal('show')
    }
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
@endsection

