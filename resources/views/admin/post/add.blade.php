@extends('layouts.master')
@section('title', 'Blog IT - Add Post')

@section('content')

    <div class="container-fluid px-4">
        <div class="card mt-4 mb-4" style="border: 1px solid #80a8b0">
            @if ($errors->any())
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11;">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-danger bg-gradient">
                            <strong class="me-auto text-dark">{{ __('Notification') }}</strong>
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
                            <strong class="me-auto text-dark">{{ __('Notification') }}</strong>
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
                <h4>{{ __('Add A New Post') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.add-post') }}" method="POST" id="postForm">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>{{ __('Content') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="category">{{ __('* Category') }}</label>
                                        <select id="category" name="category_id" class="form-control is-invalid">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($category as $cateitem)
                                                <option value="{{ $cateitem->id }}">{{ $cateitem->name }}</option>
                                            @endforeach
                                        </select>
                                        <div id="categoryError" class="invalid-feedback">Please select a category.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="postName">{{ __('* Post Name (Max 255 characters)') }}</label>
                                        <input type="text" id="postName" name="name" class="form-control"
                                            autocomplete="off">
                                        <div id="postNameError" class="invalid-feedback">Post name is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description">{{ __('* Description (Max 20000 characters)') }}</label>
                                        <textarea id="summernote" name="description" class="form-control"></textarea>
                                        <div id="descriptionError" class="invalid-feedback">Description is required.</div>
                                    </div>

                                    <div class="mb-2">
                                        <label for="ytIframe">{{ __('Link Youtube') }}</label>
                                        <input type="text" id="ytIframe" name="yt_iframe" class="form-control is-valid"
                                            autocomplete="off" placeholder="https://www.youtube.com/watch?v=example">
                                        <div id="ytIframeError" class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>{{ __('SEO Tags') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="metaTitle">{{ __('* Meta Title (Max 60 characters)') }}</label>
                                        <input type="text" id="metaTitle" name="meta_title" class="form-control"
                                            autocomplete="off">
                                        <div id="metaTitleError" class="invalid-feedback">Meta title is required.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label
                                            for="metaDescription">{{ __('* Meta Description (Max 160 characters)') }}</label>
                                        <textarea id="metaDescription" name="meta_description" class="form-control" rows="5"></textarea>
                                        <div id="metaDescriptionError" class="invalid-feedback">Meta description is
                                            required.
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="metaKeywords">{{ __('* Meta Keywords (Max 100 characters)') }}</label>
                                        <textarea id="metaKeywords" name="meta_keyword" class="form-control" rows="5"></textarea>
                                        <div id="metaKeywordsError" class="invalid-feedback">Meta keywords are required.
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3" style="border: 1px solid #007fab">
                                <div class="card-header" style="background-color: #d3e0e4">
                                    <h4>{{ __('Status') }}</h4>
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
    <script type="text/javascript">
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

        // Validate trường văn bản với giới hạn ký tự và ký tự đặc biệt
        function validateTextField(input, errorElement, maxLength = null, allowSpecialChars = true) {
            const value = input.value.trim();
            let isValid = value !== '';

            if (isValid && maxLength !== null) {
                isValid = value.length <= maxLength;
                if (!isValid) {
                    errorElement.textContent = `The field must not exceed ${maxLength} characters.`;
                }
            }

            if (isValid && !allowSpecialChars) {
                const specialCharRegex = /[^a-zA-Z0-9\s]/;
                isValid = !specialCharRegex.test(value);
                if (!isValid) {
                    errorElement.textContent = 'The field must not contain special characters.';
                }
            }

            if (isValid) {
                errorElement.textContent = 'This field is required.';
            }

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
            const value = input.value.trim();

            if (value === '') {
                // Nếu trống, không cần hiển thị lỗi
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                errorElement.style.display = 'none';
                return true;
            }
            const ytRegex = /^https:\/\/www\.youtube\.com\/watch\?v=([\w-]{11})$/;
            const isValid = ytRegex.test(value);
            if (!isValid) {
                errorElement.textContent = 'Enter a valid YouTube link (e.g., https://www.youtube.com/watch?v=example)';
            } else {
                errorElement.textContent = '';
                const videoId = value.match(ytRegex)[1];
                // console.log("Extracted Video ID:", videoId); // Lưu video ID nếu cần
            }
            validateField(input, errorElement, isValid);
            return isValid;
        }

        // Áp dụng sự kiện validate trực tiếp
        document.getElementById('category').addEventListener('change', function() {
            validateSelectField(this, document.getElementById('categoryError'));
        });

        document.getElementById('postName').addEventListener('input', function() {
            validateTextField(this, document.getElementById('postNameError'), 255);
        });

        document.getElementById('summernote').addEventListener('input', function() {
            validateTextField(this, document.getElementById('descriptionError'), 20000);
        });

        document.getElementById('ytIframe').addEventListener('input', function() {
            validateYoutubeField(this, document.getElementById('ytIframeError'));
        });

        document.getElementById('metaTitle').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaTitleError'), 60, false);
        });

        document.getElementById('metaDescription').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaDescriptionError'), 160, false);
        });

        document.getElementById('metaKeywords').addEventListener('input', function() {
            validateTextField(this, document.getElementById('metaKeywordsError'), 100, false);
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
                document.getElementById('postNameError'),
                255
            );
            const isDescriptionValid = validateTextField(
                document.getElementById('summernote'),
                document.getElementById('descriptionError'),
                20000
            );
            const isYoutubeValid = validateYoutubeField(
                document.getElementById('ytIframe'),
                document.getElementById('ytIframeError')
            );
            const isMetaTitleValid = validateTextField(
                document.getElementById('metaTitle'),
                document.getElementById('metaTitleError'),
                60,
                false
            );
            const isMetaDescriptionValid = validateTextField(
                document.getElementById('metaDescription'),
                document.getElementById('metaDescriptionError'),
                160,
                false
            );
            const isMetaKeywordsValid = validateTextField(
                document.getElementById('metaKeywords'),
                document.getElementById('metaKeywordsError'),
                100,
                false
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
            }
        });
    </script>
@endsection
