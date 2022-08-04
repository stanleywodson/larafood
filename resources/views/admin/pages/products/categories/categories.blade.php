@extends('adminlte::page')

@section('title', 'Produtos Vinculados')

@section('content_header')
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-10">
            <h1>Produtos- <b>{{$product->title}}</b></h1>
            @include('admin.includes.alerts')
        </div>
    </div>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categorias - Vinculados</a></li>
    </ol>

@stop

@section('content')

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
            @foreach($product->categories as $category)
                <tr>

                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
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

    </script>
@stop
