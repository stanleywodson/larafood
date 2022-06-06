@extends('adminlte::page')

@section('title', 'Cadastrar Perfil')

@section('content_header')
<h1>Cadastrar Perfil</h1>

@include('admin.includes.alerts')

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('profiles.store')}}">
            @csrf
            @include('admin.pages.profiles._partials.form_profile')
        </form>
    </div>
</div>
@endsection