@extends('layouts.app')

@section('title', $category->name . ' - ' . $post->name)
@section('title', "$post->meta_title")
@section('meta_description', "$post->meta_description")
@section('meta_keyword', "$post->meta_keyword")

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9 mb-3">
                <div class="category-heading">
                    <h4 class='fw-bold font-monospace'>{{ $category->name }} / {!! $post->name !!}</h4>
                </div>

                <div class="card card-shadow mt-3">
                    @if ($post->yt_iframe)
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/{{ $post->yt_iframe }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen="">
                            </iframe>
                        </div>
                    @endif

                    <div class="card-body post-description">
                        {!! $post->description !!}
                    </div>
                </div>

                <div class="comment-area mt-3">

                    @if (session('error'))
                        <h6 class="alert alert-warning mb-3">{{ @session('error') }}</h6>
                    @endif
                    @if (session('message'))
                        <h6 class="alert alert-success mt-3">{{ session('message') }}</h6>
                    @endif

                    <div class="card card-body">
                        <h6 class="card-title">Leave a comment</h6>
                        <form action="{{ url('comments') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_slug" value="{{ $post->slug }}">
                            <textarea class="form-control" name="comment_body" rows="3" required></textarea>
                            <button type="submit" class="btn btn-primary mt-3 float-end">Send Comment</button>
                        </form>
                    </div>

                    @forelse ($post->comments->sortByDesc('created_at') as $comment)
                        <div class="comment-container card card-body shadow-sm mt-3">
                            <div class="detail-area">
                                <h6 class="user-name mb-1">
                                    {{-- @if ($comment->user && $comment->user->profile && $comment->user->profile->avatar)
                                        <img src="{{ asset('uploads/avatar/' . $comment->user->profile->avatar) }}"
                                            alt="User Avatar" class="rounded-circle" width="32" height="32"
                                            style="border: 1px solid red; overflow: hidden; object-fit: cover;">
                                    @else --}}
                                    <i class="bi bi-person-circle" style="font-size: 32px;"></i>
                                    {{-- @endif --}}
                                    {{-- <h5> --}}
                                    @if ($comment->user)
                                        <span>{{ $comment->user->name }}</span>
                                    @endif
                                    {{-- </h5> --}}
                                    <small class="ms-3 text-primary float-end">
                                        {{ $comment->created_at->timezone('UTC')->setTimezone('Asia/Bangkok')->format('H:i - d/m/Y') }}</small>
                                </h6>
                                <p class="user-comment mb-1">
                                    {!! $comment->comment_body !!}
                                </p>
                            </div>

                            <div>
                                {{-- <small class="ms-3 text-primary">
                                    {{ $comment->created_at->timezone('UTC')->setTimezone('Asia/Bangkok')->format('H:i - d/m/Y') }}</small> --}}
                                {{-- @if (Auth::check() && $comment->user_id == Auth::user()->id) --}}
                                @if (Auth::check() && Auth::id() == $comment->user_id)
                                    {{-- <a href="" class="btn btn-primary btn-sm me-2">Edit</a> --}}
                                    <button type="button" value="{{ $comment->id }}"
                                        class="deleteComment btn btn-danger btn-sm me-2">Delete</button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="card card-body shadow-sm mt-3">
                            <h6>Don't have any comments? Leave your comment below!</h6>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="col-md-3
                            mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Posts</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($latest_posts as $latest_post)
                            <a href="{{ url('category/' . $latest_post->category->slug . '/' . $latest_post->slug) }}"
                                class="text-decoration-none">
                                <h6> > {{ $latest_post->name }}</h6>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.deleteComment', function() {
                if (confirm('Are you sure you want to delete this comment?')) {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: 'POST',
                        url: "/delete-comment",
                        // method: 'DELETE',
                        data: {
                            _token: _token,
                            'comment_id': comment_id
                        },
                        success: function(response) {
                            if (response.status == 200) {
                                thisClicked.closest('.comment-container').remove();
                                // alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
