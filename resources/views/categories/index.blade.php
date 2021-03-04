@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add Categories</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        
        @if(count($categories) > 0)
        <div class="card-body">
            <table class="table">
              
                <thead>
                    <th>Name</th>
                    <th>Post Count</th>
                </thead>

                <tbody>
                    @foreach($categories as $category)

                        <tr>
                        
                            <td>{{ $category->name }}</td>

                            <td>{{ $category->posts->count() }}</td>

                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})" >Delete</button>
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
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
                <h3>No Categories</h3>
            </div>
        @endif

        
    </div>
@endsection


@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('deleteCategoryForm');
            form.action = '/categories/' + id;
            console.log('Deleting', form);
            $('#deleteModal').modal('show')
        }
    </script>
@endsection