@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')

@stop

@section('content')
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Cargo</th>
                <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cargos as $cargo)
            <tr>
                <td>{{ucwords($cargo->name)}}</td>
                <td>{{$cargo->description}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@stop

@section('css')
@stop

