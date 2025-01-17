@extends('layouts.master')

@section('title', 'User List')

@section('content')
    <div class="container-fluid px-4">
        <div class="card mt-4">

            @if ($errors->any())
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger bg-gradient">
                            <strong class="me-auto text-dark">Notification</strong>
                            <small>{{ now()->diffForHumans() }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            <script>
                                setTimeout(function() {
                                    var toastElement = document.getElementById('liveToast');
                                    var toast = new bootstrap.Toast(toastElement);
                                    toast.hide();
                                }, 10000);
                            </script>
                        </div>
                        @foreach ($errors->all() as $error)
                            <div class="toast-body" style="color: black !important;">
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('status'))
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success bg-gradient">
                            <strong class="me-auto text-dark">Notification</strong>
                            <small>{{ now()->diffForHumans() }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            <script>
                                setTimeout(function() {
                                    var toastElement = document.getElementById('liveToast');
                                    var toast = new bootstrap.Toast(toastElement);
                                    toast.hide();
                                }, 10000);
                            </script>
                        </div>
                        <div class="toast-body" style="color: black !important;">
                            {{ session('status') }}
                        </div>
                    </div>
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
                                        <a href="{{ url('admin/users/' . $item->id) }}" class="btn border rounded-3">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
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
