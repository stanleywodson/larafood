@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
<h1>Editar Plano:  <b>{{$plan->name}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('plans.update', $plan->url)}}">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            @include('admin.pages.plans._partials.form_plan')
            
        </form>
    </div>
</div>
@endsection