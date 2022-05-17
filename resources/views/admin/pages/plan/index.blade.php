@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark">Adicionar</a></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="POST" action="{{ route('plans.search') }}" class="form form-inline">
            @csrf
            <input type="text" name="filter" class="form-control" placeholder="Nome do Plano">
            <button type="submit" class="btn btn-dark">Pesquisar</button>
        </form>
    </div>
</div>
<div class="card-body">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plans as $plan)
            <tr>
                <td>{{$plan->name}}</td>
                <td>{{$plan->price}}</td>
                <td>{{$plan->description}}</td>
                <td style="width: 10px;">
                    <a href="{{route('plans.show', $plan->url)}}" class="btn btn-warning">VER</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div class="card-footer">
    
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