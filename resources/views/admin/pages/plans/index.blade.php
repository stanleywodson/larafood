@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')
<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
    <div class="col-md-10">
        <h1>Planos <a href="{{route('plans.create')}}" class="btn btn-dark"><i class="fa fa-plus-square"></i></a></h1>
    </div>
</div>
<ol class="breadcrumb" style="margin-top: 20px">
    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
</ol>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <!-- formulário de pesquisa -->
        <form method="POST" action="{{ route('plans.search') }}" class="form form-inline">
            @csrf
            <div class="row">     
                    <input type="text" name="filter" class="form-control" placeholder="Nome do Plano">
                    <button type="submit" class="btn btn-dark"><i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </form>
    </div>
</div>
<div class="card-body">
    <!-- listagem dos planos -->
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
                <td>{{ucwords($plan->name)}}</td>
                <td>R$ - {{number_format($plan->price, 2, ',','.')}}</td>
                <td>{{$plan->description}}</td>
                <td style="width: 350px;">
                    <a href="{{route('details.plans.index', $plan->url)}}" class="btn btn-primary"><i class="fa fa-adjust" aria-hidden="true"></i></a>
                    <a href="{{route('plans.show', $plan->url)}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{route('plans.edit', $plan->url)}}" class="btn btn-warning"><i class="fas fa-edit"></i></i></a>
                    <a href="{{route('plans.profiles', $plan->id)}}" class="btn btn-secondary"><i class="far fa-fw fa-address-book"></i></a>
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