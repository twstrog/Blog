@extends('layouts.master')

@section('title', 'Edit Role User')

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
                <h4 class="">Edit Users
                    <a href="{{ url('admin/users') }}" class=" float-end btn btn-danger">Back</a>
                </h4>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label for="">Full Name</label>
                    <p class="form-control">{{ $users->name }}</p>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <p class="form-control">{{ $users->email }}</p>
                </div>
                <div class="mb-3">
                    <label for="">Created At</label>
                    <p class="form-control">{{ $users->created_at->format('H:i:s - d/m/Y') }}</p>
                </div>
                <form action="{{ url('admin/update-role/' . $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role_as" class="form-control">
                            <option value="2" {{ $users->role_as == '2' ? 'selected' : '' }}>Super Admin</option>
                            <option value="1" {{ $users->role_as == '1' ? 'selected' : '' }}>Admin</option>
                            <option value="0" {{ $users->role_as == '0' ? 'selected' : '' }}>User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
