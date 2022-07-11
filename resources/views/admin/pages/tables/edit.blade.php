@extends('adminlte::page')

@section('title', 'Editar Mesa')

@section('content_header')
<h1>Editar Mesa:  <b>{{$table->identity}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('tables.update', $table->id)}}">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            @include('admin.pages.tables._partials.form_tables')

        </form>
    </div>
</div>
@endsection
