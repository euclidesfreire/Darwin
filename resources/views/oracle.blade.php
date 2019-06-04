@extends('adminlte::page')

@section('title', 'Oracle Finance')

@section('content_header')
     <div class="">
        <h3>Predição de Cotação</h3>
    </div>
@stop

@section('content')
    @include('formulario');

     <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Real</th>
                <th>Predição</th>
                <th>Erro</th>
            </tr>
        </thead>
        <tbody>
            @for($i=($datasetSize-1);$i>25;$i--)
            <tr>
                    <td>{{ $dataset[$i][0] }}</td>
                    <td>{{ $dataset[$i][4] }}</td>
                    <td>{{ $close[$i] }}</td>
                    <td>{{ ($variant[$i]) }}</td>
            @endfor
        </tbody>
    </table>
@stop