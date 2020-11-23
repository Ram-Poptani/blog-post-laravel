@extends('layouts.app')

@section('content')

    {{-- <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('register') }}"  class="btn btn-primary" onclick="event.preventDefault();
        document.getElementById('logout-form').submit(); window.location.href = '{{ route('register') }}';">Add User</a>
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div> --}}
    <div class="card">
        <div class="card-header">Users</div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Posts Count</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src($user->email) }}" alt="">
                            </td>
                            <td class="text-capitalize">
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                {{ $user->posts->count() }}
                            </td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type = "submit" class="btn btn-outline-danger">Make Admin</button>
                                    </form>
                                @else
                                    <p>No Actions</p>
                                {{-- <form action="{{ route('users.remove-admin', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type = "submit" class="btn btn-outline-danger">Make Admin</button>
                                </form> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

