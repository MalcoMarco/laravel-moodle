<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/egresado/egresadoComponent.js'])
	</x-slot>
    <div id="egresadoComponent" class="card">
        <egresado-component></egresado-component>
    </div>
</x-dashboard-layout>