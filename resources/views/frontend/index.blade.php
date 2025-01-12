@extends('layouts.app')

@section('title', 'Welcome to Blog IT')

@section('meta_description',
    'Blog IT là nguồn tài nguyên tuyệt vời với các bài viết sâu sắc về công nghệ, phát triển
    phần mềm, hướng dẫn lập trình và phát triển web. Cập nhật những xu hướng và mẹo mới nhất trong thế giới công nghệ.')

@section('meta_keyword', 'blog it, blog it manager, blog it nmc, blog it nmc id, blog it nmc id vn')

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
                    <h4>Blog IT</h4>
                    <div class="underline"></div>
                    <p>
                        Blog IT là một không gian chia sẻ kiến thức về công nghệ, phát triển phần mềm, lập trình, thiết kế
                        web, và các xu hướng mới nhất trong ngành công nghệ thông tin. Tại đây, bạn sẽ tìm thấy các bài viết
                        chuyên sâu, hướng dẫn chi tiết và các mẹo vặt hữu ích giúp bạn nâng cao kỹ năng lập trình, tối ưu
                        hóa dự án và cập nhật những công nghệ tiên tiến. Hãy ghé thăm blog IT để khám phá những bài viết bổ
                        ích và kết nối với cộng đồng công nghệ.
                    </p>
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
