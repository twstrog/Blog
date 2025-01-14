@extends('layouts.master')

@section('title', 'Blog IT - Post')

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
                <h4 class="">View Post
                    <a href="{{ route('admin.add-post') }}" class="btn border rounded-3 float-end">
                        <i class="fa-solid fa-plus"></i>
                        Add Post
                    </a>
                </h4>
            </div>
            <div class="card-body">
                <form action="">
                    @csrf
                    <table id="myDataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Post Name</th>
                                <th>State</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->status == '1' ? 'Hidden' : 'Visible' }}</td>
                                    <td>
                                        <a href="{{ url('admin/post/' . $item->id) }}" class="btn border rounded-3">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/delete-post/' . $item->id) }}" class="btn border rounded-3"
                                            onclick="return confirm('Are you sure want to delete this post?');">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
@endsection
