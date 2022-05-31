@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
<h1>Informações do Perfil</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Nome:</b>      {{$profile->name}}</li>
            <li><b>Descrição:</b> {{$profile->description}}</li>
        </ul>
        <form method="POST" action="{{ route('profiles.destroy', $profile->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
    
</div> 
@endsection  