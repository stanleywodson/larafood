@extends('adminlte::page')

@section('title', "Detalhes do Plano - {$plan->name}")

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plans.index', $plan->url) }}">Detalhes</a></li>
</ol>

@stop

@section('content')
<div class="row">
<div class="col-md-10">
    <h1>Plano - <b>{{$plan->name}}</b></h1>
    @include('admin.includes.alerts')
</div>
<div class="col-6 col-md-2"><a href="{{route('details.plans.create', $plan->url)}}" class="btn btn-dark">Adicionar Detalhe</a></div>
</div>
<div class="card-body">
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $detail)
            <tr>
                <td>{{$detail->name}}</td>
                <td style="width: 200px;">
                    <a href="{{route('details.plans.show', [$plan->url,$detail->id])}}" class="btn btn-primary">VER</a>
                    <a href="{{route('details.plans.edit', [$plan->url,$detail->id])}}" class="btn btn-warning">EDITAR</a>
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