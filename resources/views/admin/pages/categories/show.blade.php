@extends('adminlte::page')

@section('title', 'Detalhes Categorias')

@section('content_header')
<h1>Informações - Categorias</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Nome:</b>      {{$category->name}}</li>
            <li><b>Descrição:</b> {{$category->description}}</li>
        </ul>
        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
</div> 
@endsection  