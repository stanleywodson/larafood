@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1> Adicionar novo detalhe ao plano - <b>{{$plan->name}}</b></h1>
    </div>
   
</div>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plans.index', $plan->url) }}">Detalhes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plans.create', $plan->url) }}">Novo</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('details.plans.store', $plan->url)}}" method="post">
            @include('admin.pages.plans.details._partials.form')
        </form>
    </div>
</div>
@endsection