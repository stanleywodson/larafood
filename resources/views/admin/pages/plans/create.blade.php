@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('plans.store')}}">
            @csrf

            @include('admin.includes.alerts')

            @include('admin.includes.form')
        </form>
    </div>
</div>
@endsection