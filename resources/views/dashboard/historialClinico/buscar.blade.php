<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/historialClinico/buscarComponent.js'])
	</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-tile mb-3">Historial Clínico</h5>
            <div class="text-end">
                <a href="{{route('historialClinico.create')}}" class="btn btn-primary">Agregar</a>
            </div>
            <div id="buscarComponent">
                <buscar-component></buscar-component>
            </div>
        </div>
        
    </div>
</x-dashboard-layout>