@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-body ">
            <form id="frmAddArticle" class="form-inline justify-content-center">
                <input type="hidden" id="csrf" value="{{csrf_token()}}">
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
                        type="text" value="0" readonly>
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
            <table class="table table-borderless table-striped table-sm">
                <thead class="thead-dark">
                    <th class="text-center">Sku</th>
                    <th class="text-center">Articulo</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio unitario</th>
                    <th class="text-center" style="width: 10em">Precio total</th>
                    <th class="text-center" style="width: 1em"></th>
                </thead>
                <tbody id="articlesList"></tbody>
                <tfoot class="table-dark">
                    <tr>
                        <td class="text-right" colspan="4">Subtotal:</td>
                        <td class="text-right" id="subtotal"></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="align-middle text-right" colspan="4">Descuento:</td>
                        <td>
                            <input type="number" min="0" value="0" id="discount"
                            class="form-control form-control-sm text-right">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="4">Total:</td>
                        <td class="text-right" id="total"></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="align-middle text-right" colspan="4">Forma de pago:</td>
                        <td>
                            <select name="payment" id="payment" 
                                class="form-control form-control-sm text-left">
                                @forelse ($paymentMethods as $id => $name)
                                    <option value="{{$id}}">{{$name}}</option>
                                @empty
                                    <option value="">No hay métodos de pago</option>
                                @endforelse
                            </select>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="4">&nbsp;</td>
                        <td class="text-right">
                            <button class="btn btn-success btn-sm" id="btnSave" disabled>
                                Finalizar venta</button>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@section('pageScripts')
    <script src="{{ asset('js/sale/create.js') }}"></script>
@endsection