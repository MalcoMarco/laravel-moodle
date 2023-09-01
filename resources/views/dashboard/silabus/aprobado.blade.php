<x-blank-layout>
    <x-slot name="head">
        <title>Sílabo | {{$silabo->curso_name}}</title>
        <link href="/coreui/css/style.css" rel="stylesheet" />
    </x-slot>
    <div class="container">
        <table class="table">
            <tr>
                <th colspan="2"><h3>Detalles del Sílabo</h1></th>
            </tr>
            <tr>
                <th>Curso</th>
                <td>{{$silabo->curso_name}} </td>
            </tr>
            <tr>
                <th>Escuela</th>
                <td>{{$silabo->escuela}} </td>
            </tr>
            <tr>
                <th>Docente</th>
                <td>{{$silabo->user->username}} {{$silabo->user->lastname}}</td>
            </tr>
            <tr>
                <th>Documento</th>
                <td>
                    <a href="{{$silabo->pdf_url}}" download role="button" class="btn btn-sm btn-primary">
                    Descargar
                    </a>
                </td>
            </tr>
        </table>
        <div class="w-100 h-100" style="min-height: 740px">
            <div class="ratio ratio-4x3 h-100">
                <iframe class="w-100 h-100" src="{{$silabo->pdf_url}}" frameborder="0"></iframe>
            </div>
        </div>
        
    </div>
</x-blank-layout>