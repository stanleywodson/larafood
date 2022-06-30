<div class="form-group">
    <label for="">Titulo</label>
    <input type="text" name="title" class="form-control" value="{{$product->title ?? old('title')}}">
</div>
<div class="form-group">
    <label for="">Preço</label>
    <input type="text" name="price" class="form-control" value="{{$product->price ?? old('price')}}">
</div>
<div class="form-group">
    <label for="">Imagem - Produto</label>
    <input type="file" name="image" class="form-control">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <input type="text" name="description" rows="5" class="form-control" value="{{$product->description ?? old('description')}}">
</div>
<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>
