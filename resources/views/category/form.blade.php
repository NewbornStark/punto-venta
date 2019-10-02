@csrf
<div class="form-group row">
    <label for="name" class="col-md-2 col-form-label">Nombre:</label>
    <div class="col-md-6">
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
    </div>
</div>
<div class="form-group row">
    <div class="col-md-6 offset-md-2">
        <button class="btn btn-sm btn-primary">{{ $btnText }}</button>
    </div>
</div>