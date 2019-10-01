@csrf
<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label">Nombre:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $article->name) }}">
    </div>
</div>
<div class="form-group row">
    <label for="sku" class="col-md-2 col-form-label">Sku:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $article->sku) }}">
    </div>
</div>
<div class="form-group row">
    <label for="price" class="col-md-2 col-form-label">Precio:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $article->price) }}">
        <span class="help-block">Precio con IVA</span>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6 offset-md-2">
        <button class="btn btn-sm btn-primary">{{ $btnText }}</button>
    </div>
</div>