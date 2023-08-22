<x-dashboard-layout>
    <x-slot name="styles">

    </x-slot>
    <x-slot name="scripts">
        {{-- @vite(['resources/js/silabus/listComponent.js']) --}}

	</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-tile mb-3">Observaciones</h5>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('status') }}</strong> 
                    <button type="button" class="btn-close" data-coreui-dismiss="alert" aria-label="Close"></button>
                  </div>
            @endif
           <table class="table">
            <tr>
                <th>Curso</th>
                <td>{{$silabo->curso_name}} </td>
            </tr>
            <tr>
                <th>Escuela</th>
                <td>{{$silabo->escuela}} </td>
            </tr>
            <tr>
                <th>Escuela</th>
                <td>{{$silabo->escuela}} </td>
            </tr>
            <tr>
                <th>Documento</th>
                <td><button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                    <i class="far fa-file-pdf"></i> ver
                  </button>
                   </td>
            </tr>
           </table>
            <div class="w-100 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Requisito</th>
                            <th>Observacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($silabo->incomplete_reqs as $key=>$item)
                            <tr>
                                <td>{{$key+1}} </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->pivot->description}}</td>
                            </tr>
                            
                            
                        @endforeach
                    </tbody>

                </table>
            </div>
            @if (Auth::user()->id == $silabo->mdl_user_id)
                <h4 class="text-center text-primary"> Adjuntar silabo corregido</h4>
                <form action="{{route('silabus.observacionUpdate',$silabo->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="formFile" class="form-label label-required">Cargar Silabo</label>
                    <input class="form-control" accept=".pdf" type="file" id="formFile" name="silabo_file" required>
                    <div class="text-muted">
                        formato: .pdf, max: 5mb
                    </div>
                    @error('silabo')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                    <div class="w-100 text-center">
                        <button class="btn btn-success">Guardar</button>
                    </div>
                </form>
            @endif
        </div>        
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Silabo</h5>
          <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="w-100 h-100" style="min-height: 640px">
                <div class="ratio ratio-4x3 h-100">
                    <iframe class="w-100 h-100" src="{{$silabo->pdf_url}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
</x-dashboard-layout>