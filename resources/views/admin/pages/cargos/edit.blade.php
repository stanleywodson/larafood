@extends('adminlte::page')

@section('title', 'Editar Cargo')

@section('content_header')
<h1>Editar Cargo:  <b>{{$cargo->name}}</b></h1>

@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{ route('cargos.update', $cargo->id) }}">
            @csrf
            @method('PUT')

            @include('admin.pages.cargos._partials.form_cargo')

        </form>
    </div>
</div>
@endsection
