@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Permissões</h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{route('permission.create')}}" class="btn btn-dark">ADD. PERMISSÃO</a></div>
</div>

<!-- <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
</ol> -->

@stop

@section('content')
<!-- <div class="card">
    <div class="card-header">
        <h1>Perfis</h1>
    </div>
</div> -->
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
            @foreach($permission as $permission)
            <tr>
                <td>{{ucwords($permission->name)}}</td>
                <td>{{$permission->description}}</td>
                <td style="width: 350px;">
                    <!-- <a href="" class="btn btn-primary">DETALHES</a> -->
                    <a href="{{ route('permission.show', $permission->id) }}" class="btn btn-info">VER</a>
                    <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-warning">EDIT</a>
                    <a href="{{ route('permissions.profiles', $permission->id) }}" class="btn btn-primary"><i class="fas fa-fw fa-user"></i></a>
                </td>
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