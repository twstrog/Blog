@extends('layouts.master')
@section('title', 'Blog IT - Add Post')

@section('content')

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4" style="border: 1px solid #80a8b0">
            @if (session('status'))
                <h5 class="alert alert-success mt-3">{{ session('status') }}</h5>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <div class="card-header" style="background-color: #80a8b0">
                <h4>Add a new post
                    {{-- <a href="{{ route('admin.post') }}" class="btn btn-sm btn-primary float-end">View Post</a> --}}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.add-post') }}" method="POST" id="postForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>Content</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="category">* Category</label>
                                        <select id="category" name="category_id" class="form-control is-invalid">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($category as $cateitem)
                                                <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="categoryError" class="invalid-feedback">Please select a category.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="postName">* Post Name</label>
                                        <input type="text" id="postName" name="name" class="form-control"
                                            autocomplete="off">
                                        <div id="postNameError" class="invalid-feedback">Post name is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">* Description</label>
                                        <textarea id="summernote" name="description" class="form-control"></textarea>
                                        <div id="descriptionError" class="invalid-feedback">Description is required.</div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="ytIframe">Youtube Link</label>
                                        <input type="text" id="ytIframe" name="yt_iframe" class="form-control is-valid"
                                            autocomplete="off" placeholder="https://www.youtube.com/watch?v=example">
                                        <div id="ytIframeError" class="invalid-feedback">
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
                                        <label for="metaTitle">* Meta Title</label>
                                        <input type="text" id="metaTitle" name="meta_title" class="form-control"
                                            autocomplete="off">
                                        <div id="metaTitleError" class="invalid-feedback">Meta title is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="metaDescription">* Meta Description</label>
                                        <textarea id="metaDescription" name="meta_description" class="form-control" rows="5"></textarea>
                                        <div id="metaDescriptionError" class="invalid-feedback">Meta description is
                                            required.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="metaKeywords">* Meta Keywords</label>
                                        <textarea id="metaKeywords" name="meta_keyword" class="form-control" rows="5"></textarea>
                                        <div id="metaKeywordsError" class="invalid-feedback">Meta keywords are required.
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
                                                <input type="checkbox" name="status">
                                                <label for="">Hidden on the home page</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
            </div>

            <div class="card-footer">
                <div class="col-md-12">
                    <a href="{{ route('admin.post') }}" class="btn btn-primary border rounded-3 float-start">All Post</a>
                    <button type="submit" class="btn btn-success border rounded-3 float-end">
                        <i class="fa-solid fa-plus"></i> Add This Post
                    </button>
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
        // Validate YouTube Iframe link
        function validateYoutubeField(input, errorElement) {
            // Chấp nhận trường hợp trống hoặc URL YouTube hợp lệ
            if (input.value.trim() === '') {
                // Nếu trống, không cần hiển thị lỗi
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                errorElement.style.display = 'none';
                return true;
            }

            const ytRegex = /^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/;
            const isValid = ytRegex.test(input.value.trim());
            validateField(input, errorElement, isValid);

            // Nếu hợp lệ, trích xuất video ID
            if (isValid) {
                const videoId = input.value.match(ytRegex)[1];
                console.log("Extracted Video ID:", videoId); // Lưu video ID nếu cần
            }
            return isValid;
        }


        // Áp dụng sự kiện validate trực tiếp
        document.getElementById('category').addEventListener('change', function() {
            validateSelectField(this, document.getElementById('categoryError'));
        });

        document.getElementById('postName').addEventListener('input', function() {
            validateTextField(this, document.getElementById('postNameError'));
        });

        document.getElementById('summernote').addEventListener('input', function() {
            validateTextField(this, document.getElementById('descriptionError'));
        });

        document.getElementById('ytIframe').addEventListener('input', function() {
            validateYoutubeField(this, document.getElementById('ytIframeError'));
        });

        document.getElementById('metaTitle').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaTitleError'));
        });

        document.getElementById('metaDescription').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaDescriptionError'));
        });

        document.getElementById('metaKeywords').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaKeywordsError'));
        });

        // Xử lý form submit
        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const isCategoryValid = validateSelectField(
                document.getElementById('category'),
                document.getElementById('categoryError')
            );
            const isPostNameValid = validateTextField(
                document.getElementById('postName'),
                document.getElementById('postNameError')
            );
            const isDescriptionValid = validateTextField(
                document.getElementById('summernote'),
                document.getElementById('descriptionError')
            );
            const isYoutubeValid = validateYoutubeField(
                document.getElementById('ytIframe'),
                document.getElementById('ytIframeError')
            );
            const isMetaTitleValid = validateTextField(
                document.getElementById('metaTitle'),
                document.getElementById('metaTitleError')
            );
            const isMetaDescriptionValid = validateTextField(
                document.getElementById('metaDescription'),
                document.getElementById('metaDescriptionError')
            );
            const isMetaKeywordsValid = validateTextField(
                document.getElementById('metaKeywords'),
                document.getElementById('metaKeywordsError')
            );

            if (
                isCategoryValid &&
                isPostNameValid &&
                isDescriptionValid &&
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
