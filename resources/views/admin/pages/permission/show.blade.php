@extends('adminlte::page')

@section('title', 'Detalhes da Permissão')

@section('content_header')
<h1>Informações - Permissão</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Nome:</b>      {{$permission->name}}</li>
            <li><b>Descrição:</b> {{$permission->description}}</li>
        </ul>
        <form method="POST" action="{{ route('permission.destroy', $permission->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
    
</div> 
@endsection  