@extends('adminlte::page')

@section('title', "Editar o detalhe - {$detail->name}")

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1> Editar o detalhe - <b>{{$detail->name}}</b></h1>
    </div>
   
</div>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.show', $plan->url) }}">{{$plan->name}}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('details.plans.index', $plan->url) }}">Detalhes</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('details.plans.edit', [$plan->url, $detail->id]) }}">Edit</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('details.plans.update', [$plan->url, $detail->id])}}" method="post">
            @method('PUT')
            @include('admin.pages.plans.details._partials.form')
        </form>
    </div>
</div>
@endsection