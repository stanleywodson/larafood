@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Permissões - <b>{{$profile->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{ route('profiles.permissions.available', $profile->id) }}" class="btn btn-dark">Adicionar - Permissão</a></div>
</div>

<!-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
</ol> -->

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
                <td>vazio</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop