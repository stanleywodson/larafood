<div class="form-group">
    <label for="">Cargo</label>
    <input type="text" name="name" class="form-control" value="{{$cargo->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" class="form-control" value="{{$cargo->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>

<!-- formulario do perfil -->
