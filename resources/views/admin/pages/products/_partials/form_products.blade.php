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
<div class="card" style="padding: 20px">
    <h5><b>Categoria</b></h5>
    <!-- tras todos as categorias onde os produtos seram inseridos-->
    @foreach($categories as $category)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="categories[]" value="{{$category->id}}">
            <label class="form-check-label" for="defaultCheck1">
                {{$category->name}}
            </label>
        </div>
    @endforeach
</div>

<div class="form-group">
    <button class="btn btn-dark">Enviar</button>
</div>
