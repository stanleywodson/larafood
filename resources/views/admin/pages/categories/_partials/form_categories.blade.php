<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$category->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" rows="5" class="form-control" value="{{$category->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>