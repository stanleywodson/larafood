<div class="form-group">
    <label for="">E-mail</label>
    <input disabled  type="email" name="email" class="form-control" value="{{$user->email ?? old('email')}}">
</div>

<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$user->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="">Senha</label>
    <input  type="password" name="password" class="form-control">
</div>

<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>
