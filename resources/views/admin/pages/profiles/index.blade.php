@extends('adminlte::page')

@section('title', 'Perfis')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Perfis</h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{route('profiles.create')}}" class="btn btn-dark">Adicionar - Perfil</a></div>
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
    
    <form method="POST" action="{{ route('profiles.search')}}" class="form form-inline">
        @csrf
        <div class="row">
            <input type="text" name="filter" class="form-control" placeholder="Nome do Usuário">
            <button type="submit" class="btn btn-dark">Pesquisar</button>
        </div>
    </form>
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
            @foreach($profiles as $profile)
            <tr>
                <td>{{ucwords($profile->name)}}</td>
                <td>{{$profile->description}}</td>
                <td style="width: 350px;">
                    <!-- <a href="" class="btn btn-primary">DETALHES</a> -->
                    <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-info">VER</a>
                    <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-warning">EDITAR</a>
                    <a href="{{ route('profiles.permissions', $profile->id) }}" class="btn btn-success">PERM</i></a>
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