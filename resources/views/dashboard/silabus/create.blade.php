<x-dashboard-layout>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Información de la asignatura</h5>
            <hr>
            <div class="row">
                <div class="col-lg-8 mb-4">
                    @foreach ($errors->all() as $message)
                        <p>{{$message}} </p>
                    @endforeach


                    <form action="{{route('silabus.store')}}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-6">
                            <label class="label-required" for="curso_name">Nombre del curso</label>
                            <input type="text" class="form-control form-control-sm" id="curso_name" name="curso_name"
                                required value="{{ old('curso_name') }}">
                                @error('curso_name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="escuela label-required">Escuela</label>
                            <input type="text" class="form-control form-control-sm" id="escuela"
                                name="escuela" required value="{{ old('escuela') }}">
                            @error('escuela')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="ciclo" class="label-required">Ciclo</label>
                            <input type="text" class="form-control form-control-sm" id="ciclo" name="ciclo" 
                             value="{{ old('ciclo') }}">
                        </div>
                        <div class="col-lg-6">
                            <label for="creditos">Creditos</label>
                            <input type="number" class="form-control form-control-sm" id="creditos" name="creditos"
                            value="{{ old('creditos') }}">
                        </div>
                        <div class="col-lg-3">
                            <label for="horas_teoricas">horas teoricas</label>
                            <input type="number" class="form-control form-control-sm" id="horas_teoricas"
                                name="horas_teoricas" value="{{ old('horas_teoricas') }}">
                        </div>
                        <div class="col-lg-3">
                            <label for="horas_practica">horas practicas</label>
                            <input type="number" class="form-control form-control-sm" id="horas_practica"
                                name="horas_practicas" value="{{ old('horas_practicas') }}">
                        </div>
                        <div class="col-sm-12">
                            <label for="formFile" class="form-label label-required">Cargar Silabo</label>
                            <input class="form-control" accept=".pdf" type="file" id="formFile" name="silabo_file" required>
                            <div class="text-muted">
                                formato: .pdf, max: 5mb
                            </div>
                            @error('silabo')
                                <p class="error-message">{{ $message }}</p>
                            @enderror

                        </div>
                        <div class="w-100 text-end mt-4">
                            <a href="{{route('silabus.index')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">El sílabo presenta la siguiente estructura</p>
                    <ul>
                        @foreach ($silaboReqs as $item)
                            <li> {{$item->name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>