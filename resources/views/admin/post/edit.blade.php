@extends('layouts.master')
@section('title', 'Blog IT - Edit Post')

@section('content')

    <div class="container-fluid px-4">
        <div class="card mt-4" style="border: 1px solid #80a8b0">
            @if ($errors->any())
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger bg-gradient">
                            <strong class="me-auto text-dark">Notification</strong>
                            <small>{{ now()->diffForHumans() }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
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
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
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

            <div class="card-header" style="background-color: #80a8b0">
                <h4 class="">Edit post: {{ $post->name }}
                    <a href="{{ route('admin.post') }}" class="btn btn-primary float-end">View all post</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/update-post/' . $post->id) }}" method="POST" id="editPostForm">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>Post Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="">* Category</label>
                                        <select id="editCategory" name="category_id" required class="form-control is-valid">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($category as $cateitem)
                                                <option value="{{ $cateitem->id }}"
                                                    {{ $post->category_id == $cateitem->id ? 'selected' : '' }}>
                                                    {{ $cateitem->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div id="editCategoryError" class="invalid-feedback">Please select a category.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">* Post Name</label>
                                        <input id="editPostName" type="text" name="name" class="form-control is-valid"
                                            value="{{ $post->name }}" autocomplete="off">
                                        <div id="editPostNameError" class="invalid-feedback">Post name is required.</div>
                                    </div>
                                    {{-- <div class="mb-3">
                                        <label for="">Slug</label>
                                        <input type="text" name="slug" class="form-control" value="{{ $post->slug }}"
                                            autocomplete="off">
                                    </div> --}}
                                    <div class="mb-3">
                                        <label for="">* Description</label>
                                        <textarea id="summernote" type="text" name="description" class="form-control" rows="4">{!! $post->description !!}</textarea>
                                        <div id="descriptionError" class="invalid-feedback">Description is required.</div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="">Youtube Link</label>
                                        @if (!empty($post->yt_iframe))
                                            <input id="editYtIframe" type="text" name="yt_iframe"
                                                class="form-control is-valid"
                                                value="https://www.youtube.com/watch?v={{ $post->yt_iframe }}"
                                                autocomplete="off">
                                        @else
                                            <input id="editYtIframe" type="text" name="yt_iframe"
                                                class="form-control is-valid" autocomplete="off">
                                        @endif

                                        <div id="editYtIframeError" class="invalid-feedback">
                                            Enter a valid YouTube link (e.g., https://www.youtube.com/watch?v=example).
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>SEO tags</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="">* Meta Title</label>
                                        <input id="editMetaTitle" type="text" name="meta_title"
                                            class="form-control is-valid" value="{{ $post->meta_title }}"
                                            autocomplete="off">
                                        <div id="editMetaTitleError" class="invalid-feedback">Meta title is required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">* Meta Description</label>
                                        <textarea id="editMetaDescription" type="text" name="meta_description" class="form-control is-valid"
                                            rows="5">{!! $post->meta_description !!}</textarea>
                                        <div id="editMetaDescriptionError" class="invalid-feedback">Meta description is
                                            required.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">* Meta keyword</label>
                                        <textarea id="editMetaKeywords" type="text" name="meta_keyword" class="form-control is-valid" rows="5">{!! $post->meta_keyword !!}</textarea>
                                        <div id="editMetaKeywordsError" class="invalid-feedback">Meta keywords are
                                            required.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>Status</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="checkbox"
                                                    name="status"{{ $post->status == '1' ? 'checked' : '' }}>
                                                <label for="">Hidden on the home page</label>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-8">
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary float-end">Update
                                                    Post</button>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-8"> --}}
                            {{-- <div class="mb-3">
                                <a href="{{ route('admin.post') }}" class="btn btn-primary float-start">View
                                    Post</a>
                                <button type="submit" class="btn btn-primary float-end">Update
                                    Post</button>
                            </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>

                    {{-- </form> --}}
            </div>

            <div class="card-footer">
                <div class="mb-3">
                    <a href="{{ url('admin/add-post') }}" class="btn btn-primary float-start">Add a new post</a>
                    <button type="submit" class="btn btn-success float-end">Update this post</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Hàm thêm hoặc loại bỏ class cho trường nhập liệu
        function validateField(input, errorElement, isValid) {
            if (isValid) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                errorElement.style.display = 'none';
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                errorElement.style.display = 'block';
            }
        }

        // Validate trường văn bản
        function validateTextField(input, errorElement) {
            const isValid = input.value.trim() !== '';
            validateField(input, errorElement, isValid);
            return isValid;
        }

        // Validate select (Category)
        function validateSelectField(input, errorElement) {
            const isValid = input.value.trim() !== '';
            validateField(input, errorElement, isValid);
            return isValid;
        }

        // Validate YouTube Iframe link
        function validateYoutubeField(input, errorElement) {
            if (input.value.trim() === '') {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                errorElement.style.display = 'none';
                return true;
            }

            const ytRegex = /^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/;
            const isValid = ytRegex.test(input.value.trim());
            validateField(input, errorElement, isValid);

            if (isValid) {
                const videoId = input.value.match(ytRegex)[1];
                console.log("Extracted Video ID:", videoId);
            }
            return isValid;
        }

        // Áp dụng sự kiện validate trực tiếp cho form Edit Post
        document.getElementById('editCategory').addEventListener('change', function() {
            validateSelectField(this, document.getElementById('editCategoryError'));
        });

        document.getElementById('editPostName').addEventListener('input', function() {
            validateTextField(this, document.getElementById('editPostNameError'));
        });

        document.getElementById('editYtIframe').addEventListener('input', function() {
            validateYoutubeField(this, document.getElementById('editYtIframeError'));
        });

        document.getElementById('editMetaTitle').addEventListener('input', function() {
            validateTextField(this, document.getElementById('editMetaTitleError'));
        });

        document.getElementById('editMetaDescription').addEventListener('input', function() {
            validateTextField(this, document.getElementById('editMetaDescriptionError'));
        });

        document.getElementById('editMetaKeywords').addEventListener('input', function() {
            validateTextField(this, document.getElementById('editMetaKeywordsError'));
        });

        // Xử lý form submit
        document.getElementById('editPostForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const isCategoryValid = validateSelectField(
                document.getElementById('editCategory'),
                document.getElementById('editCategoryError')
            );
            const isPostNameValid = validateTextField(
                document.getElementById('editPostName'),
                document.getElementById('editPostNameError')
            );
            const isYoutubeValid = validateYoutubeField(
                document.getElementById('editYtIframe'),
                document.getElementById('editYtIframeError')
            );
            const isMetaTitleValid = validateTextField(
                document.getElementById('editMetaTitle'),
                document.getElementById('editMetaTitleError')
            );
            const isMetaDescriptionValid = validateTextField(
                document.getElementById('editMetaDescription'),
                document.getElementById('editMetaDescriptionError')
            );
            const isMetaKeywordsValid = validateTextField(
                document.getElementById('editMetaKeywords'),
                document.getElementById('editMetaKeywordsError')
            );

            if (
                isCategoryValid &&
                isPostNameValid &&
                isYoutubeValid &&
                isMetaTitleValid &&
                isMetaDescriptionValid &&
                isMetaKeywordsValid
            ) {
                this.submit(); // Gửi form nếu tất cả hợp lệ
            } else {
                // alert('Please fix the errors before submitting.');
            }
        });
    </script>

@endsection
