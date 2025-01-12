<div class="shadow-sm border-bottom sticky-top">
    <div class="top-navbar">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <a class="top-nav-link">Follow Us:</a>
                    <a href="https://www.facebook.com/nm.cuong04" class="top-nav-link br-r">Facebook</a>
                    <a href="https://www.instagram.com/nm.cuong04/" class="top-nav-link">Instagram</a>
                </div>
                <div class="col-md-6 text-end">
                    {{-- <a class="top-nav-link br-r" href="#" target="_blank">Download</a> --}}
                    {{-- <p class="top-nav-link br-r">{{ date('d/m/Y') }}</p> --}}
                    {{-- <a class="top-nav-link br-r time" href="">Today is {{ date('d/m/Y') }}</a> --}}
                    <a class="top-nav-link br-r"
                        href="">{{ now()->setTimezone('Asia/Bangkok')->format('d/m/Y') }}</a>
                    <a class="top-nav-link" href="https://nmc.id.vn" target="_blank">My Website</a>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="https://nmc.id.vn/assets/images/logo-blogit.png" class="nav-logo" alt="Blog IT"
                    style="pointer-events: none !important;" />
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li> --}}
                    @php
                        $categories = App\Models\Category::where('navbar_status', '0')->where('status', '0')->get();
                    @endphp
                    @foreach ($categories as $cateitem)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ url('category/' . $cateitem->slug) }}">{{ $cateitem->name }}</a>
                        </li>
                    @endforeach
                    {{-- <li class="nav-item my-auto">
                        <a class="btn1-outline" href="/login">Đăng nhập</a>
                    </li> --}}

                    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                        <li class="nav-item dropdown">
                            {{-- <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> --}}
                            {{-- <i class="fas fa-user fa-fw"></i> --}}
                            {{-- {{ Auth::user()->name }} --}}
                            @guest
                            <li class="nav-item my-auto">
                                <a class="btn1-outline" href="{{ route('login') }}">
                                    <i class="bi bi-box-arrow-in-right" style="padding-right: 5px;"></i>
                                    {{ __('Login') }}
                                </a>
                                {{-- <a class="btn1-outline" href="/login">Đăng nhập</a> --}}
                            </li>
                        @else
                            {{-- <li class="nav-item my-auto"> --}}
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{-- <i class="fas fa-user fa-fw"></i> --}}
                                <i class="bi bi-person-circle"></i>
                                {{ Auth::user()->name }}
                            </a>
                            {{-- </li> --}}
                        @endguest
                        {{-- </a> --}}
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ url('/profile') }}">{{ __('My Information') }}</a>
                            </li>

                            <li>
                                <a class="dropdown-item"
                                    href="{{ url('/password/change') }}">{{ __('Password Change') }}
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            @if ((auth()->check() && auth()->user()->isAdmin()) || (auth()->check() && auth()->user()->isSuperAdmin()))
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ url('/admin/dashboard') }}">{{ __('Switch To Admin') }}
                                    </a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                            @endif

                            @if (auth()->check() && auth()->user()->isSuperAdmin())
                                <li>
                                    <a class="dropdown-item" href="#!">{{ __('Settings') }}</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#!">{{ __('Activity log') }}</a>
                                </li>

                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        </li>
                    </ul>

                </ul>
            </div>
        </div>
    </nav>
</div>
