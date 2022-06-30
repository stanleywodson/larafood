@extends('adminlte::page')

@section('title', 'Cadastrar Produto')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('products.store')}}" enctype="multipart/form-data">
            @csrf

            @include('admin.includes.alerts')

            @include('admin.pages.products._partials.form_products')
        </form>
    </div>
</div>
@endsection
