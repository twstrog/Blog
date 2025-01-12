@extends('layouts.app')

{{-- @section('title', $category->name . '') --}}
@section('title', "$category->meta_title")
@section('meta_description', "$category->meta_description")
@section('meta_keyword', "$category->meta_keyword")

@section('content')
    {{-- <div class="py-5"> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="category-heading">
                    <h4 class='fw-bold font-monospace'>{{ $category->name }}</h4>
                </div>

                @forelse ($post as $postitem)
                    <div class="card card-shadow mt-3">
                        <div class="card-body">
                            {{-- <div class="d-flex"> --}}
                            <a href="{{ url('category/' . $category->slug . '/' . $postitem->slug) }}"
                                class="d-flex align-items-center">
                                <div class="calendar">
                                    <div class="month px-1">{{ $postitem->created_at->format('F') }}</div>
                                    <div class="day">{{ $postitem->created_at->format('d') }}</div>
                                </div>
                                <div class="content">
                                    <h2 class="post-heading">{{ $postitem->name }}</h2>
                                </div>
                            </a>

                            {{-- <div class="row">
                                <div class="col-6">
                                    <h6>Post On: {{ $postitem->created_at->format('d-m-Y') }}</h6>
                                </div>
                                <div class="col-6">
                                    <h6 class="float-end">Post By: {{ $postitem->user->name }}</h6>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                @empty
                    <div class="card card-shadow mt-4">
                        <div class="card-body">
                            <h>No Post Avaliable</h>
                        </div>
                    </div>
                @endforelse

                <div class="cmcblog-paginate mt-4 float-end">
                    {{ $post->links() }}
                </div>

            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
