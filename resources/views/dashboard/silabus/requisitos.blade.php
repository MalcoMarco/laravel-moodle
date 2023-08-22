<x-dashboard-layout>
    <x-slot name="scripts">
        @vite(['resources/js/silabus/requisitosComponent.js'])
	</x-slot>
    <div class="card" id="requisitos-component">
        <requisitos-component></requisitos-component>
    </div>
</x-dashboard-layout>