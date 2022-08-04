@extends('adminlte::page')

@section('title', 'Detalhes do Cargo')

@section('content_header')
<h1>Informações - Cargo</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Cargo:</b>      {{$cargo->name}}</li>
            <li><b>Descrição:</b> {{$cargo->description}}</li>
        </ul>
        <form method="POST" action="{{ route('cargos.destroy', $cargo->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>

</div>
@endsection
