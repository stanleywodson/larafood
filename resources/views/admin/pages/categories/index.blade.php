@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Categorias <a href="{{route('categories.create')}}" class="btn btn-dark"><i class="fa fa-plus-square"></i></a></h1>
    </div>
</div>

<ol class="breadcrumb" style="margin-top: 20px">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <!-- formulário de pesquisa -->
        <form method="POST" action="{{ route('categories.search') }}" class="form form-inline">
            @csrf
            <div class="row">     
                    <input type="text" name="filter" class="form-control" placeholder="Nome da Categoria">
                    <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="card-body">
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ucwords($category->name)}}</td>
                <td>{{$category->description}}</td>
                <td>
                    <a href="{{route('categories.show', $category->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!');
</script>
@stop