@extends('adminlte::page')

@section('title', 'Editar Plano')

@section('content_header')
<h1>Editar Perfil:  <b>{{$profile->name}}</b></h1>

@include('admin.includes.alerts')
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{ route('profiles.update', $profile->id) }}">
            @csrf
            @method('PUT')
            
            @include('admin.pages.profiles._partials.form_profile')
            
        </form>
    </div>
</div>
@endsection
