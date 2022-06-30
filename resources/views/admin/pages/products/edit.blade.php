@extends('adminlte::page')

@section('title', 'Editar - Produto')

@section('content_header')
<h1>Editar Produto:  <b>{{$product->title}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('products.update', $product->id)}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            @include('admin.pages.products._partials.form_products')

        </form>
    </div>
</div>
@endsection
