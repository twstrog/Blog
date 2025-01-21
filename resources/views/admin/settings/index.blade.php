@extends('layouts.master')

@section('title', 'Blog IT - Settings')

@section('content')
    <div class="container-fluid">
        <div class="row py-4">
            <div class="col-md-12 px-4">
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

                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Settings') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/settings') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>{{ __('Website') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="website-name">{{ __('* Name (Max 50 characters)') }}</label>
                                                <input type="text" name="website_name" class="form-control"
                                                    autocomplete="off"
                                                    @if ($setting) value="{{ $setting->website_name ?? '' }}" @endif>
                                            </div>

                                            <div class="mb-3">
                                                <label>{{ __('* Description (Max 5000 characters)') }}</label>
                                                <textarea type="text" name="description" class="form-control" rows="7" autocomplete="off">{{ $setting->description ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>{{ __('Image') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row text-center">
                                                <div class="col border rounded-3 mx-2 p-3">
                                                    <input type="file" name="website_logo" class="form-control mb-2">
                                                    <label>Logo Now: </label>
                                                    @if ($setting)
                                                        <img src="{{ asset('uploads/settings/' . $setting->logo) }}"
                                                            width="100" alt="logo">
                                                    @endif
                                                </div>
                                                <div class="col border rounded-3 mx-2 p-3">
                                                    <input type="file" name="website_favicon" class="form-control mb-2">
                                                    <label>Favicon Now: </label>
                                                    @if ($setting)
                                                        <img src="{{ asset('uploads/settings/' . $setting->favicon) }}"
                                                            width="32" alt="favicon">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>{{ __('SEO - Meta Tags') }}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label>{{ __('* Meta Title (Max 100 characters)') }}</label>
                                                <input type="text" name="meta_title" class="form-control"
                                                    autocomplete="off"
                                                    @if ($setting) value="{{ $setting->meta_title ?? '' }}" @endif>
                                            </div>
                                            <div class="mb-3">
                                                <label>{{ __('* Meta Description (Max 255 characters)') }}</label>
                                                <textarea name="meta_description" class="form-control" rows="5" autocomplete="off">{{ $setting->meta_description ?? '' }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label>{{ __('* Meta Keywords (Max 255 characters)') }}</label>
                                                <textarea name="meta_keyword" class="form-control" rows="4" autocomplete="off">{{ $setting->meta_keyword ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <strong class="text-warning">
                            Last Update: {{ $setting->updated_at->setTimezone('Asia/Bangkok')->format('h:i:s - d/m/Y') }}
                        </strong>
                        <button type="submit" class="btn btn-primary rounded-3 border float-end">Save</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
