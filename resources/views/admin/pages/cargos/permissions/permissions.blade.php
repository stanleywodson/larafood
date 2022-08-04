@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Permissões - <b>{{$cargo->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{ route('cargos.permissions.available', $cargo->id) }}" class="btn btn-dark">Adicionar - Permissão</a></div>
</div>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cargos.index') }}">Cargos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cargos.permissions',[$cargo->id]) }}">Permissões Vinculadas</a></li>
</ol>

@stop

@section('content')

<div class="card-body">
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->name}}</td>
                <td>{{$permission->description}}</td>
                <td><a href="{{ route('cargos.permissions.detach',[$cargo->id, $permission->id]) }}" class="btn btn-danger">DESVINCULAR</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@stop

@section('css')

@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop
