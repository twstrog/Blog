@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <main style="flex-grow: 1;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>My Profile</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form action="{{ route('auth.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-8">

                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Fillable</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Enter Your Name" value="{{ $profile->name }}"
                                                        autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description">Description (Maximum length 255
                                                        characters)</label>
                                                    <textarea name="description" class="form-control" value="" autocomplete="off" rows="3">{{ $profile->description }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h4>Unfillable</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group mb-3">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" class="form-control" disabled
                                                        value="{{ $profile->email }}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="updated_at">Last Updated At</label>
                                                    <input type="text" name="updated_at" class="form-control" disabled
                                                        value="{{ $profile->updated_at }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Avatar</div>
                                            <div class="card-body">
                                                {{-- <div class="form-group mb-3"> --}}
                                                {{-- <label for="">Avatar</label> --}}
                                                <input type="file" name="avatar" class="form-control">
                                                {{-- </div> --}}
                                            </div>
                                            <div class="card-footer">
                                                <div class="container d-flex justify-content-center ">
                                                    <img src="{{ asset('uploads/avatar/' . $profile->avatar) }}"
                                                        width="100%" height="auto" alt="Avatar" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
