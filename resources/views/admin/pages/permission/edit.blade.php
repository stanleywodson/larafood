@extends('adminlte::page')

@section('title', 'Editar Permissões')

@section('content_header')
<h1>Editar Permissão:  <b>{{$permission->name}}</b></h1>

@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{ route('permission.update', $permission->id) }}">
            @csrf
            @method('PUT')
            
            @include('admin.includes.form_permission')
            
        </form>
    </div>
</div>
@endsection
