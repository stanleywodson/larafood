@extends('adminlte::page')

@section('title', 'Cadastrar Cargo')

@section('content_header')
<h1>Cadastrar Cargo</h1>

@include('admin.includes.alerts')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('cargos.store')}}">
            @csrf
            @include('admin.pages.cargos._partials.form_cargo')
        </form>
    </div>
</div>
@endsection
