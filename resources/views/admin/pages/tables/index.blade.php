@extends('adminlte::page')

@section('title', 'Mesas')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Mesas <a href="{{route('tables.create')}}" class="btn btn-dark"><i class="fa fa-plus-square"></i></a></h1>
    </div>
</div>

<ol class="breadcrumb" style="margin-top: 20px">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <!-- formulário de pesquisa -->
        <form method="POST" action="{{ route('tables.search') }}" class="form form-inline">
            @csrf
            <div class="row">
                    <input type="text" name="filter" class="form-control" placeholder="Nome da Mesa">
                    <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="card-body">
    @include('admin.includes.alerts')
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Identificação</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
            <tr>
                <td>{{ucwords($table->identity)}}</td>
                <td>{{$table->description}}</td>
                <td>
                    <a href="{{route('tables.show', $table->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{route('tables.edit', $table->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
