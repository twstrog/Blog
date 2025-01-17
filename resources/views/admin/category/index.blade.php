@extends('layouts.master')

@section('title', 'Blog IT - Category')

@section('content')


    <div class="container-fluid px-4">
        <div class="card mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-success bg-gradient">
                            {{-- <img src="{{ asset('path-to-your-image.png') }}" class="rounded me-2" alt="Icon"> --}}
                            <strong class="me-auto text-dark">Notification</strong>
                            <small>{{ now()->diffForHumans() }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            <script>
                                setTimeout(function() {
                                    var toastElement = document.getElementById('liveToast');
                                    var toast = new bootstrap.Toast(toastElement);
                                    toast.hide();
                                }, 3000);
                            </script>
                        </div>
                        <div class="toast-body" style="color: black !important;">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-header">
                <h4 class="">View Category
                    <a href="{{ url('admin/add-category') }}" class="btn border rounded-3 float-end">
                        <i class="fa-solid fa-plus"></i> Add Category
                    </a>
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
                                            class="btn border rounded-3">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/delete-category/' . $item->id) }}"
                                            class="btn border rounded-3"
                                            onclick="return confirm('Are you sure want to delete this category with it post?');">
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
