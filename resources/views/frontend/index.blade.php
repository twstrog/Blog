@extends('layouts.app')

@section('title', $setting->meta_title)
@section('meta_description', $setting->meta_description)
@section('meta_keyword', $setting->meta_keyword)

@section('content')
    <div class="bg-category py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-1">
                    <div class="owl-carousel owl-theme">
                        @foreach ($all_category as $item)
                            <div class="item p-1">
                                <a href="{{ url('category/' . $item->slug) }}" class="text-decoration-none">
                                    <div class="card p-1 item-category">
                                        <img class="img-category" src="{{ asset('uploads/category/' . $item->image) }}"
                                            alt="Image">
                                        <div class="card-body text-center">
                                            <h5 class="text-dark">{{ $item->name }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5" style="background-color: #ddd">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>{{ $setting->website_name }}</h4>
                    <div class="underline"></div>
                    <p>{{ $setting->description }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Another Categories</h4>
                    <div class="underline"></div>
                </div>
                @foreach ($all_category as $item)
                    <div class="col-md-3">
                        <div class="card card-body shadow mb-3">
                            <a href="{{ url('category/' . $item->slug) }}" class="text-decoration-none">
                                <h5 class="text-dark mb-0">{{ $item->name }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Latest Posts</h4>
                    <div class="underline"></div>
                </div>
                @foreach ($latest_posts as $item)
                    <div class="col-md-3">
                        <div class="card card-body shadow mb-3">
                            <a href="{{ url('category/' . $item->category->slug . '/' . $item->slug) }}"
                                class="text-decoration-none">
                                <h5 class="text-dark mb-0">{{ $item->name }}</h5>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
