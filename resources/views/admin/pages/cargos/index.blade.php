@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Cargos</h1>
        @include('admin.includes.alerts')
    </div>
    <div class="col-6 col-md-2"><a href="{{route('cargos.create')}}" class="btn btn-dark">Adicionar - Cargo</a></div>
</div>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('cargos.index') }}">Cargos</a></li>
</ol>

@stop

@section('content')
<!-- <div class="card">
    <div class="card-header">
        <h1>Perfis</h1>
    </div>
</div> -->
<div class="card-body">

    <form method="POST" action="{{ route('cargos.search')}}" class="form form-inline">
        @csrf
        <div class="row">
            <input type="text" name="filter" class="form-control" placeholder="Nome do Cargo">
            <button type="submit" class="btn btn-dark">Pesquisar</button>
        </div>
    </form>
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Cargo</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cargos as $cargo)
            <tr>
                <td>{{ucwords($cargo->name)}}</td>
                <td>{{$cargo->description}}</td>
                <td style="width: 350px;">
                    <!-- <a href="" class="btn btn-primary">DETALHES</a> -->
                    <a href="{{ route('cargos.show', $cargo->id) }}" class="btn btn-info">VER</a>
                    <a href="{{ route('cargos.edit', $cargo->id) }}" class="btn btn-warning">EDITAR</a>
{{--                    <a href="{{ route('cargos.plans', $cargo->id) }}" class="btn btn-info">PLANOS</a>--}}
                    <a href="{{ route('cargos.permissions', $cargo->id) }}" class="btn btn-success"><i class="fas fa-fw fa-lock"></i></a>

                </td>
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
