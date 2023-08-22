<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/silabus/listComponent.js'])
	</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-tile mb-3">Mis Sílabos</h5>
            <div class="text-end">
                <a href="{{route('silabus.create')}}" class="btn btn-primary">Agregar Silabo</a>
            </div>
            <div id="list-component">
                <list-component
                    url-api-data="{{route('silabus.list')}}"                
                    permissions="{{json_encode((Auth::user()->permissions()))}}"
                    roles="{{json_encode((Auth::user()->roles()))}}"
                >
                </list-component>
            </div>
        </div>
        
    </div>
</x-dashboard-layout>