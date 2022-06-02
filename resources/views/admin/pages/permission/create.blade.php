@extends('adminlte::page')

@section('title', 'Cadastrar Permissão')

@section('content_header')
<h1>Cadastrar Permissão</h1>

@include('admin.includes.alerts')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('permission.store')}}">
            @csrf
            @include('admin.includes.form_permission')
        </form>
    </div>
</div>
@endsection