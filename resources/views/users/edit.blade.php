@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">My profile</div>

    <div class="card-body">
        <form action="{{ route('users.update-profile') }}" method="POST">
            @csrf
            @method('PUT')
            @include('partial.errors')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{ $user->about }}</textarea>
            </div>

            <button class="btn btn-success" type="submit">Update Profile</button>

        </form>
       
    </div>
</div>
@endsection
