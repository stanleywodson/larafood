<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" value="{{$plan->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">Preço</label>
    <input type="text" name="price" class="form-control" value="{{$plan->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" class="form-control" value="{{$plan->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Editar</button>
</div>