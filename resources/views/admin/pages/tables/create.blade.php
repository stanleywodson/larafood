@extends('adminlte::page')

@section('title', 'Cadastrar Mesa')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('tables.store')}}">
            @csrf

            @include('admin.includes.alerts')

            @include('admin.pages.tables._partials.form_tables')
        </form>
    </div>
</div>
@endsection
