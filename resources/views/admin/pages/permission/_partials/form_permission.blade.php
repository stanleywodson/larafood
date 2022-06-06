<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$permission->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" class="form-control" value="{{$permission->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>

<!-- formulario do perfil -->