<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                @if (auth()->check() && auth()->user()->isSuperAdmin())
                    <div class="sb-sidenav-menu-heading">Interface Super Admin</div>
                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}"
                        href="{{ route('admin.users') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        User
                    </a>
                    <a class="nav-link {{ Request::is('admin/activity-logs') ? 'active' : '' }}"
                        href="{{ route('activity-logs.index') }}">
                        <div class="sb-nav-link-icon">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        Activity Logs
                    </a>
                @endif

                <div class="sb-sidenav-menu-heading">Interfaces</div>
                <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'collapse active' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false"
                    aria-controls="collapseCategory">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/category') || Request::is('admin/add-category') || Request::is('admin/edit-category/*') ? 'show' : '' }}"
                    id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/add-category') ? 'active' : '' }}"
                            href="{{ route('admin.add-category') }}">Add Category</a>
                        <a class="nav-link {{ Request::is('admin/category') || Request::is('admin/edit-category/*') ? 'active' : '' }}"
                            href="{{ route('admin.category') }}">View Category</a>
                    </nav>
                </div>
                <a class="nav-link {{ Request::is('admin/posts') || Request::is('admin/add-post') || Request::is('admin/post/*') ? 'collapse active' : 'collapsed' }}"
                    href="#" data-bs-toggle="collapse" data-bs-target="#collapsePosts" aria-expanded="false"
                    aria-controls="collapsePosts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse {{ Request::is('admin/posts') || Request::is('admin/add-post') || Request::is('admin/post/*') ? 'show' : '' }}"
                    id="collapsePosts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link {{ Request::is('admin/add-post') ? 'active' : '' }}"
                            href="{{ route('admin.add-post') }}">Add Post</a>
                        <a class="nav-link {{ Request::is('admin/posts') || Request::is('admin/post/*') ? 'active' : '' }}"
                            href="{{ route('admin.post') }}">View Post</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Tools</div>
                {{-- <a class="nav-link {{ Request::is('admin/tools') ? 'active' : '' }}" href="{{ url('admin/tools') }}"> --}}
                <a class="nav-link {{ Request::is('admin/tools') ? 'active' : '' }}"
                    href="{{ route('admin.tools') }}">
                    <div class="sb-nav-link-icon">
                        <i class="fa-solid fa-toolbox"></i>
                    </div>
                    Characters Count
                </a>

                <div class="sb-sidenav-menu-heading">Contact</div>
                <a class="nav-link" href="https://nmc.id.vn/portfolio" target="_blank">
                    <div class="sb-nav-link-icon">
                        <i class="fa-regular fa-address-book"></i>
                    </div>
                    NMC
                </a>
            </div>
        </div>

        <div class="sb-sidenav-footer">
            <div class="small text-center">Version: 1.2</div>
        </div>
    </nav>
</div>
