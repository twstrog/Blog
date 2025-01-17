@extends('layouts.master')

@section('title', 'My Information')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                        <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger bg-gradient">
                                <strong class="me-auto text-dark">Notification</strong>
                                <small>{{ now()->diffForHumans() }}</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
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

                <div class="card mt-5">
                    <div class="card-header">
                        <h3>My Information<a href="{{ route('admin.dashboard') }}"
                                class="btn btn-primary float-end">Back</a>
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
