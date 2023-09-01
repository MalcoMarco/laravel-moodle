<header class="header header-sticky mb-4">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fas fa-bars"></i>
        </button>
        <a class="header-brand d-md-none" href="#">
            <x-application-logo style="width: 118px; height: 46px"></x-application-logo>
        </a>
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item">
                <a class="nav-link" href="{{config('app.url_moodle')}}">Moodle Proyect</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="#">Users</a>
            </li> --}}
        </ul>
        <nav class="header-nav ms-auto me-4">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                <input class="btn-check" id="btn-light-theme" type="radio" name="theme-switch" autocomplete="off"
                    value="light" onchange="handleThemeChange(this)" />
                <label class="btn btn-primary" for="btn-light-theme">
                    <i class="fas fa-sun"></i>
                </label>
                <input class="btn-check" id="btn-dark-theme" type="radio" name="theme-switch" autocomplete="off"
                    value="dark" onchange="handleThemeChange(this)" />
                <label class="btn btn-primary" for="btn-dark-theme">
                    <i class="fas fa-moon"></i>
                </label>
            </div>
        </nav>
        <ul class="header-nav me-4">
            <li class="nav-item dropdown d-flex align-items-center">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="avatar avatar-md">
                        <img class="avatar-img"
                            src="{{Auth::user()->picture_url}}" alt="." />
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                        {{-- <div class="fw-semibold">Account</div> --}}
                        {{Auth::user()->firstname}}
                    </div>
                    {{-- <a class="dropdown-item" href="#">
                        Updates<span class="badge badge-sm bg-info-gradient ms-2">42</span>
                    </a>
                        
                    <div class="dropdown-header bg-light py-2 dark:bg-white dark:bg-opacity-10">
                        <div class="fw-semibold">Settings</div>
                    </div> --}}
                    <a class="dropdown-item" href="{{ config('app.url_moodle').'/user/profile.php' }}">
                        Profile</a>
                    <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('logout') }}">
                        Logout</a>
                </div>
            </li>
        </ul>
        {{-- discomment if required aside
        <button class="header-toggler px-md-0 me-md-3" type="button"
            onclick="coreui.Sidebar.getInstance(document.querySelector('#aside')).show()"></button>
        --}}
    </div>
    {{-- breadcrumb
        <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <span>Home</span>
                </li>
                <li class="breadcrumb-item active">
                    <span>Dashboard</span>
                </li>
            </ol>
        </nav>
    </div> --}}
</header>