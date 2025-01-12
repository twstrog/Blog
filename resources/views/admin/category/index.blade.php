@extends('layouts.master')

@section('title', 'Blog IT - Category')

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
                <h4 class="">View Category
                    <a href="{{ url('admin/add-category') }}" class="btn btn-sm btn-primary float-end">Add Category</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="">
                    @csrf
                    <table id="myDataTable" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/category/' . $item->image) }}" alt=""
                                            width="48px" height="auto">
                                    </td>
                                    <td>{{ $item->status == 1 ? 'Hidden' : 'Shown' }}</td>
                                    <td>
                                        <a href="{{ url('admin/edit-category/' . $item->id) }}"
                                            class="btn btn-success">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/delete-category/' . $item->id) }}" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category with it post?');">Delete</a>
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
