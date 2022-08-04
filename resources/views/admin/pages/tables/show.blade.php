@extends('adminlte::page')

@section('title', 'Detalhes Categorias')

@section('content_header')
<h1>Informação - Mesa</h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Identificação:</b>{{$table->identity}}</li>
            <li><b>Descrição:</b> {{$table->description}}</li>
        </ul>
        <form method="POST" action="{{ route('tables.destroy', $table->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
</div>
@endsection
