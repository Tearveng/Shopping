@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
        Carts
    </div>

    @if(count($carts) > 0)
    <div class="card-body">
        <table class="table">

            <thead>
                <th>Name</th>
                <th>User</th>
                <th>Option</th>

            </thead>

            

            <tbody>
                @foreach($carts as $cart)

                <tr>
                    <td><img src="{{ asset('storage/'.$cart->image) }}" width="120px" height="60px" alt=""></td>
                   
                    <td>{{ $cart->user->name }}</td>

                    <!-- <td>
                        <a class="btn btn-warning btn-sm"> Edit</a>
                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $cart->id }})">Delete</button>
                    </td> -->

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
        <h3>No Carts</h3>
    </div>
    @endif


</div>
@endsection


@section('scripts')
<script>
    function handleDelete(id) {
        var form = document.getElementById('deleteCategoryForm');
        form.action = '/carts/' + id;
        console.log('Deleting', form);
        $('#deleteModal').modal('show')
    }
</script>
@endsection