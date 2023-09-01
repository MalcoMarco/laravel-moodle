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
        
        <li class="nav-title">Modulos</li>
        <li class="nav-group">
            <a class="nav-link nav-group-toggle" href="#">
                <i class="fas fa-file nav-icon"></i> Sílabos
            </a>
            <ul class="nav-group-items">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('silabus.index')}}"><span class="nav-icon"></span> Mis Sílabos</a>
                </li>
                @if (Auth::user()->isSiteadmin())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('silabuReqs.form')}}"><span class="nav-icon"></span> Requerimientos</a>
                </li>                
                @endif
            </ul>
        </li>
        @can('crd_historialClinico')
            {{-- <li class="nav-title">Topicos</li> --}}
            <li class="nav-item">
                <a class="nav-link" href="{{route('historialClinico.index')}}">
                    <i class="fas fa-notes-medical nav-icon"></i>
                    Hist. Clinico</a>
            </li>
        @endcan
        @can('crd_seguimientoEgresado')
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users nav-icon"></i>
                    Seg. Egresados</a>
            </li>
        @endcan
        @can('crd_bolsaTrabajo')
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-briefcase nav-icon"></i>
                    Bolsa Trabajo</a>
            </li>
        @endcan

        {{-- <li class="nav-group">
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
        </li> --}}

        {{-- <li class="nav-item">
            <a class="nav-link" href="widgets.html">
                <i class="fas fa-question nav-icon"></i>
                Widgets<span class="badge bg-info-gradient ms-auto">NEW</span></a>
        </li> --}}
        <li class="nav-divider"></li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>