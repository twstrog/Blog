@extends('layouts.master')

@section('title', 'My Information')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <h5 class="alert alert-success mt-3">{{ session('status') }}</h5>
                @endif

                <div class="card mt-5">
                    <div class="card-header">
                        <h3>My Information<a href="{{ route('admin.dashboard') }}" class="btn btn-primary float-end">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="container d-flex justify-content-center ">
                                <img src="{{ asset('uploads/avatar/' . $profile->avatar) }}" class="rounded-5"
                                    width="100px" height="100px" alt="Avatar" />
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" disabled
                                    value="{{ $profile->email }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Your Name"
                                    value="{{ $profile->name }}" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Avatar</label>
                                <input type="file" name="avatar" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description">Description (Maximum length 255 characters)</label>
                                <textarea name="description" class="form-control" value="" autocomplete="off" rows="3">{{ $profile->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="updated_at">Last Updated At</label>
                                <input type="text" name="updated_at" class="form-control" disabled
                                    value="{{ $profile->updated_at }}" autocomplete="off">
                            </div>
                            <div class="form-group mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
