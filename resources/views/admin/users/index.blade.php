@extends('layouts.master')

@section('title', 'User List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">
            @if (session('status'))
                <h5 class="alert alert-success mt-3">{{ session('status') }}</h5>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card-header">
                <h4 class="">View Users</h4>
            </div>
            <div class="card-body">
                <form action="">
                    @csrf
                    <table id="myDataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Log Last Active</th>
                                <th>Created At</th>
                                <th>Edit</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        {{ $item->role_as == '2' ? 'Super Admin' : ($item->role_as == '1' ? 'Admin' : 'User') }}
                                    </td>
                                    <td>
                                        {{-- {{ $item->last_active->timezone('UTC')->setTimezone('Asia/Bangkok')->format('H:i:s - d/m/Y') }} --}}
                                        @if ($item->last_active)
                                            {{ \Illuminate\Support\Facades\Date::parse($item->last_active)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $item->created_at->timezone('UTC')->setTimezone('Asia/Bangkok')->format('H:i:s - d/m/Y') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/' . $item->id) }}" class="btn btn-success">Edit
                                            Role</a>
                                    </td>
                                    {{-- <td>
                                        <a href="{{ url('admin/delete-user/' . $item->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
