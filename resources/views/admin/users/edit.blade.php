@extends('layouts.master')

@section('title', 'Edit Role User')

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
