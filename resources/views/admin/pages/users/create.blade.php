@extends('adminlte::page')

@section('title', 'Cadastrar Usuário')

@section('content_header')
<h1>Cadastrar</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('users.store')}}">
            @csrf

            @include('admin.includes.alerts')

            @include('admin.pages.users._partials.form_user_create')
        </form>
    </div>
</div>
@endsection