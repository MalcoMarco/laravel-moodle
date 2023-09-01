<x-dashboard-layout>
    <x-slot name="styles">
        <style>
            .custom-switch .form-check-input:checked {
                background-color: #d32f2f;
                border-color: #d32f2f;
            }
        </style>
    </x-slot>
    <x-slot name="scripts">
        {{-- @vite(['resources/js/silabus/listComponent.js']) --}}
        <script>
            function toggleTextarea(id) {
                var textarea = document.getElementById('txt_'+id);
                var checkbox = document.getElementById('swith_'+id);
                console.log(id+' _checkbox.checked: ',checkbox.checked);
                textarea.disabled = !checkbox.checked;
                if (!checkbox.checked) {
                    textarea.value = ""
                }
            }
            const alertList = document.querySelectorAll('.alert')
            const alerts = [...alertList].map(element => new coreui.Alert(element))
        </script>
	</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-tile mb-3">Revisar Sílabo</h5>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }} <strong>{{ session('message') }}</strong> 
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
            <div class="row">
                <div class="col-lg-6" style="min-height: 640px">
                    <div class="ratio ratio-4x3 h-100">
                        <iframe class="w-100 h-100" src="{{$silabu->pdf_url}}" frameborder="0"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{route('silabus.makereview',$silabu->id)}}" method="POST">
                        @csrf
                        <table class="table mb-3">
                            <thead>
                                <tr>
                                    <th>Requisito</th>
                                    <th>Si-No</th>
                                    <th>Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($silaboReqs as $clave => $item)
                                @php
                                    $checked=false;
                                    $description="";
                                    $Key_incomplete_reqs = array_search($item->id, array_column($silabu->incomplete_reqs->toArray(), "id"));
                                    if ($Key_incomplete_reqs !== false) {
                                        $checked=true;
                                        $description=$silabu->incomplete_reqs[$Key_incomplete_reqs]->pivot->description;
                                    }
                                    
                                @endphp
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <div class="custom-switch">
                                            <label class="form-check-label label-no" for="swith_{{$item->id}}">SI</label>
                                            <div class="form-check form-switch">
                                                <input value="{{$item->id}}" 
                                                 name="requisitos[{{$clave}}][id]"
                                                 class="form-check-input" type="checkbox" 
                                                 role="switch" 
                                                 id="swith_{{$item->id}}"
                                                 onchange="toggleTextarea({{$item->id}})"
                                                 {{$checked?'checked':''}}
                                                >
                                                <label class="form-check-label label-si" for="swith_{{$item->id}}">NO</label>
                                            </div>
                                        </div>
                                      </td>
                                    <td>
                                        <textarea id="txt_{{$item->id}}" 
                                            name="requisitos[{{$clave}}][description]" 
                                            {{$checked?'':'disabled'}}
                                            class="form-control" 
                                            rows="1">{{$description}}</textarea>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <a href="{{route('silabus.index')}}" role="button" class="btn btn-default me-4">volver</a>
                            <button type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</x-dashboard-layout>