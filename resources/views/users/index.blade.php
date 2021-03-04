@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="" class="btn btn-success">Add Users</a>
    </div>

    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        @if(count($users) > 0)
           
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img width="40px" height="40px" style="border-radius: 50%;" src="{{ Gravatar::src($user->email) }}" alt="">
                            </td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>
                                    @if(!$user->isAdmin())
                                       <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                            @csrf

                                            <button class="btn btn-success btn-sm" type="submit">Make Admin</button>
                                       </form>
                                    @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="card-body text-center">
                <h3>No Users</h3>
            </div>
        @endif
    </div>
@endsection