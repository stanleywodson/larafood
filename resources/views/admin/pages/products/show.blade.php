@extends('adminlte::page')

@section('title', 'Detalhes Produtos')

@section('content_header')
<h1>Informações - Produtos</h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li>
                {{$product->image}}
            </li>
            <li><b>Nome:</b>      {{$product->title}}</li>
            <li>R$ - {{number_format($product->price, 2, ',','.')}}</li>
            <li><b>Descrição:</b> {{$product->description}}</li>

        </ul>
        <form method="POST" action="{{ route('products.destroy', $product->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
</div>
@endsection
