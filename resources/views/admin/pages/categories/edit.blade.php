@extends('adminlte::page')

@section('title', 'Editar Categorias')

@section('content_header')
<h1>Editar Categoria:  <b>{{$category->name}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('categories.update', $category->id)}}">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            @include('admin.pages.categories._partials.form_categories')
            
        </form>
    </div>
</div>
@endsection