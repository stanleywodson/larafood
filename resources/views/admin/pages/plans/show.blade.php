@extends('adminlte::page')

@section('title', 'Detalhes do Plano')

@section('content_header')
<h1>Detalhes do plano: <b>{{$plan->name}}</b></h1>
@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <ul>
            <li><b>Nome:</b>      {{$plan->name}}</li>
            <li><b>Url: </b>      {{$plan->url}}</li>
            <li><b>Descrição:</b> {{$plan->description}}</li>
            <li><b>Preço R$: </b>   {{number_format($plan->price, 2, ',', '.')}}</li>
        </ul>
        <form method="POST" action="{{ route('plans.destroy', $plan->url) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Excluir</button>
    </form>
    </div>
    
</div> 
@endsection  