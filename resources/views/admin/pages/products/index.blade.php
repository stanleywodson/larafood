@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Produtos <a href="{{route('products.create')}}" class="btn btn-dark"><i class="fa fa-plus-square"></i></a></h1>
    </div>
</div>

<ol class="breadcrumb" style="margin-top: 20px">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <!-- formulário de pesquisa -->
        <form method="POST" action="{{ route('products.search') }}" class="form form-inline">
            @csrf
            <div class="row">
                    <input type="text" name="filter" class="form-control" placeholder="Nome do Produto">
                    <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="card-body">
    @include('admin.includes.alerts')
    <!-- listagem dos planos -->
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Imagem</th>
                <th>Titulo</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><img src="{{url("storage/".$product->image)}}" alt="" style="max-width: 150px"></td>
                <td>{{ucwords($product->title)}}</td>
                <td>R$ - {{number_format($product->price, 2, ',','.')}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <a href="{{route('products.show', $product->id)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
