@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Permissões - <b>{{$permissions->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
</div>

 <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissões</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.profiles', $permissions->id) }}">Perfis - Vinculados</a></li>
</ol> 

@stop

@section('content')

<div class="card-body">
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions->profiles as $profile)
            <tr>
                <td>{{$profile->name}}</td>
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
    
</script>
@stop