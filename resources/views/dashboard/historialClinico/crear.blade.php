<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/historialClinico/crearComponent.js'])
	</x-slot>
    <div class="card" id="crearHistorialClinico">
        <crear-component/>       
    </div>
</x-dashboard-layout>