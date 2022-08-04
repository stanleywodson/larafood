<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="identity" class="form-control" value="{{$table->identity ?? old('identity')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" rows="5" class="form-control" value="{{$table->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>
