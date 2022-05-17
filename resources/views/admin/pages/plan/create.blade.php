@extends('adminlte::page')

@section('title', 'Cadastrar Novo Plano')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('plans.store')}}">
            @csrf
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" name="name" class="form-control" placeholder="Nome:">
            </div>
            <div class="form-group">
                <label for="">Preço</label>
                <input type="text" name="price" class="form-control" placeholder="Preço">
            </div>
            <div class="form-group">
                <label for="">Descrição</label>
                <input type="text" name="description" class="form-control" placeholder="Descrição:">
            </div>
            <div class="form-group">
                <button class="btn btn-dark">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection