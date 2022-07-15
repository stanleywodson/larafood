@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Usuários <a href="{{route('users.create')}}" class="btn btn-dark"><i class="fa fa-plus-square"></i></a></h1>
        @include('admin.includes.alerts')
    </div>
</div>

<ol class="breadcrumb" style="margin-top: 20px">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
                <!-- pesquisa usuários -->
                <form method="POST" action="{{ route('users.search')}}" class="form form-inline">
                    @csrf
                    <div class="row">
                        <input type="text" name="filter" class="form-control" placeholder="Nome do Usuário">
                        <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </form>
    </div>
</div>
<div class="card-body">

    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ucwords($user->name)}}</td>
                <td>{{$user->email}}</td>
                <td style="width: 350px;">
                    <!-- <a href="" class="btn btn-primary">DETALHES</a> -->
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>

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
