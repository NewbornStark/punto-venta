@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body ">
            <form id="frmAddArticle" class="form-inline justify-content-center">
                @csrf
                <div class="input-group" id="divSelectArticle">
                    <div class="list-group" id="possibleArticles"
                        style="position:absolute; top: 2rem; z-index:10">
                    </div>
                    <input type="text" class="form-control" placeholder="# Articulo"
                        id="noArticle" autocomplete="off">
                </div>
                <div id="selectedArticleText" style="display:none;">
                        <label class="mr-1" id="selectedArticleLabel"></label>
                        <i class="fa fa-times text-danger" id="cancelArticle" title="Cancelar"></i>
                </div>
                <div class="input-group justify-content-center">
                    <div class="input-group-prepend">
                        <button 
                            class="btn btn-sm btn-secondary" id="subQuantity">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input class="form-control col-md-2 text-center" id="quantity"
                    type="text" value="0">
                    <div class="input-group-append">
                        <button class="btn btn-sm btn-secondary" id="addQuantity">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn btn-md btn-success"
                    id="btnAddArticle" disabled>Agregar</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Articulos</div>
        <div class="card-body">
            <table class="table table-borderless table-striped">
                <thead>
                    <th class="text-center">Sku</th>
                    <th class="text-center">Articulo</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio unitario</th>
                    <th class="text-center" style="width: 10em">Precio total</th>
                    <th class="text-center" style="width: 1em"></th>
                </thead>
                <tbody id="articlesList"></tbody>
            </table>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{ asset('js/sale/create.js') }}"></script>
@endsection