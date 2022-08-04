@extends('adminlte::page')

@section('title', 'Produtos Vinculados')

@section('content_header')
    <!-- Stack the columns on mobile by making one full-width and the other half-width -->
    <div class="row">
        <div class="col-md-10">
            <h1>Categoria - <b>{{$category->name}}</b></h1>
            @include('admin.includes.alerts')
        </div>
    </div>

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.products', $category->id) }}">Produtos - Vinculados</a></li>
    </ol>

@stop

@section('content')

    <div class="card-body">
        <!-- listagem dos planos -->
        <table class="table table-condensed">
            <thead>
            <tr>
                <th>Imagem</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category->products as $product)
                <tr>
                    <td><img src="{{url('storage/'.$product->image)}}" alt=""></td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->description}}</td>
                    <td class="btn btn-danger"><a href="{{route('categories.products.detach',[$category->id, $product->id])}}">desvincular - produto</a></td>
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
