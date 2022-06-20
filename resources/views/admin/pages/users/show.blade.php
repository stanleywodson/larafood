@extends('adminlte::page')

@section('title', 'Detalhes - Usuário')

@section('content_header')
<h1>Informações - usero</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Nome:</b>      {{ucfirst($user->name) }}</li>
            <li><b>E-mail: </b>      {{$user->email}}</li>
            <li><b>Empresa: </b>      {{ucfirst($user->tenant->name)}}</li>
        </ul>
        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
    </form>
    </div>
    
</div> 
@endsection  