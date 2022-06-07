@extends('adminlte::page')

@section('title', 'Planos/Perfis')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Planos - <b>{{$plan->name}}</b></h1>
        @include('admin.includes.alerts')
    </div>
    <a href="{{ route('plans.profiles.available', $plan->id) }}" class="btn btn-primary">add. perfil</a>
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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profiles as $profile)
            <tr>
                <td>{{$profile->name}}</td>
                <td><a href="{{ route('plans.profiles.detach',[$plan->id, $profile->id]) }}" class="btn btn-danger">DESVINCULAR</a></td>
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