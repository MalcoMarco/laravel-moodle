<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <x-application-logo class="sidebar-brand-full" width="118" height="46"/>
        <x-application-logo class="sidebar-brand-narrow" width="46" height="46"/>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="fas fa-tachometer-alt nav-icon"></i> Dashboard<span class="badge bg-info-gradient ms-auto">NEW</span></a>
        </li>
        <li class="nav-title">Theme</li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fas fa-palette nav-icon"></i>
                Colors</a>
        </li>
        <li class="nav-title">Modulos</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-puzzle-piece nav-icon"></i> Silabus
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('silabus.index')}}"><span class="nav-icon"></span> Mis Silabus</a>
                </li>
                @if (Auth::user()->isSiteadmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('silabuReqs.form')}}"><span class="nav-icon"></span> Requerimientos</a>
                </li>                
                @endif
            </ul>
        </li>

        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-question nav-icon"></i>
                Buttons</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="buttons/buttons.html"><span class="nav-icon"></span> Buttons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buttons/button-group.html"><span class="nav-icon"></span> Buttons
                        Group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buttons/loading-buttons.html">
                        Loading Buttons<span class="badge bg-danger-gradient ms-auto">PRO</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buttons/dropdowns.html"><span class="nav-icon"></span> Dropdowns</a>
                </li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-question nav-icon"></i>
                Forms</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="forms/form-control.html">
                        Form Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/select.html">
                        Select</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/multi-select.html"><span class="nav-icon"></span> Multi
                        Select<span class="badge bg-danger-gradient ms-auto">PRO</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/checks-radios.html">
                        Checks and radios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/range.html">
                        Range</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/input-group.html">
                        Input group</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/floating-labels.html">
                        Floating labels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/date-picker.html">
                        Date Picker<span class="badge bg-success ms-auto">LAB</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/date-range-picker.html">
                        Date Range Picker<span class="badge bg-success ms-auto">LAB</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/time-picker.html">
                        Time Picker<span class="badge bg-success ms-auto">LAB</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/layout.html">
                        Layout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms/validation.html">
                        Validation</a>
                </li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-question nav-icon"></i>
                Icons</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="icons/coreui-icons-free.html">
                        CoreUI Icons<span class="badge bg-success ms-auto">Free</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="icons/coreui-icons-brand.html">
                        CoreUI Icons - Brand</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="icons/coreui-icons-flag.html">
                        CoreUI Icons - Flag</a>
                </li>
            </ul>
        </li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-question nav-icon"></i>
                Notifications</a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="notifications/alerts.html"><span class="nav-icon"></span> Alerts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications/badge.html"><span class="nav-icon"></span> Badge</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications/modals.html"><span class="nav-icon"></span> Modals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="notifications/toasts.html"><span class="nav-icon"></span> Toasts</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="widgets.html">
                <i class="fas fa-question nav-icon"></i>
                Widgets<span class="badge bg-info-gradient ms-auto">NEW</span></a>
        </li>
        <li class="nav-divider"></li>
        <li class="nav-title">System Utilization</li>
        <li class="nav-item px-3 d-narrow-none">
            <div class="text-uppercase mb-1">
                <small><b>CPU Usage</b></small>
            </div>
            <div class="progress progress-thin">
                <div class="progress-bar bg-info-gradient" role="progressbar" style="width: 25%" aria-valuenow="25"
                    aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-medium-emphasis-inverse">348 Processes. 1/4 Cores.</small>
        </li>
        <li class="nav-item px-3 d-narrow-none">
            <div class="text-uppercase mb-1">
                <small><b>Memory Usage</b></small>
            </div>
            <div class="progress progress-thin">
                <div class="progress-bar bg-warning-gradient" role="progressbar" style="width: 70%"
                    aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-medium-emphasis-inverse">11444GB/16384MB</small>
        </li>
        <li class="nav-item px-3 mb-3 d-narrow-none">
            <div class="text-uppercase mb-1">
                <small><b>SSD 1 Usage</b></small>
            </div>
            <div class="progress progress-thin">
                <div class="progress-bar bg-danger-gradient" role="progressbar" style="width: 95%"
                    aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-medium-emphasis-inverse">243GB/256GB</small>
        </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>