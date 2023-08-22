<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/example-component.js'])
	</x-slot>
    <div class="card">
        <div id="example">
            <example-component></example-component>
        </div>
        <div class="card-body">
            welcome Auth User:
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li>{{Auth::user()}}</li>
                        <li>Roles: @json(Auth::user()->roles())</li>
                        <li>Es Siteadmin: {{Auth::user()->isSiteadmin()?'YES':'NO'}}</li>
                        <li>hasRole('student') : {{Auth::user()->hasRole('student')?'YES':'NO'}}</li>
                        <li>Permisos List: @json(Auth::user()->permissions())</li>
                        <li>hasPermission('read_modulo_gestion_silabus'): {{Auth::user()->hasPermission('read_modulo_gestion_silabus')?'YES':'NO'}}</li>
                        <li>
                            use with @@can(crud_modulo_matricula_estudiante)
                            @can('crud_modulo_matricula_estudiante')
                                <em> si puede</em>
                            @else
                                <em> no puede</em>
                            @endcan

                        </li>
                    </ul>                    

                </div>
                <div class="col-md-6 ps-5">
                    Roles:
                    <table class="table">
                        <tr>
                            <td>x</td>
                            <td>siteadmin (rol siteadmin ficticio)</td>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->shortname}}</td>
                            </tr>
                        @endforeach
                    </table>
                    <hr>
                    Permissions:
                    <table class="table">
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                            </tr>                            
                        @endforeach
                    </table>
                </div>
                <div class="colmd-12">
                    Role has Permissions:
                    <table class="table">
                        <tr>
                            <td>siteadmin</td>
                            <td>['permisos a todo'] (ficcticio)</td>
                        </tr>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->shortname}}</td>
                                <td>
                                    [
                                         @foreach ($role->permissions as $permission)
                                            {{$permission->name}},
                                        @endforeach
                                    ]
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>