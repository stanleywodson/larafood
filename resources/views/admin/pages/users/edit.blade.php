@extends('adminlte::page')

@section('title', 'Editar Usuário')

@section('content_header')
<h1>Editar Usuário:  <b>{{$user->name}}</b></h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form method="post" action="{{route('users.update', $user->id)}}">
            @csrf
            @method('PUT')

            @include('admin.includes.alerts')

            @include('admin.pages.users._partials.form_user_edit')
            
        </form>
    </div>
</div>
@endsection