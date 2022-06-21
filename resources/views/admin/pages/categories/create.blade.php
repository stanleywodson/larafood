@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('categories.store')}}">
            @csrf

            @include('admin.includes.alerts')

            @include('admin.pages.categories._partials.form_categories')
        </form>
    </div>
</div>
@endsection