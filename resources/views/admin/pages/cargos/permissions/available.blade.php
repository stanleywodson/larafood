@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Vincular Permissão - <b>{{$cargo->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
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
                <th width="50px">#</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            <form action="{{ route('cargos.permissions.attach', $cargo->id) }}" method="post">
                @csrf
            @foreach($permissions as $permission)
            <tr>
                <td>
                    <input type="checkbox" name="permissions[]" value="{{$permission->id}}">
                </td>
                <td>
                    {{$permission->name}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="500"><button type="submit" class="btn btn-success">Vincular</button></td>
            </tr>
            </form>
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
