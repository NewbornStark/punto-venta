@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('sale.create') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Nueva venta
                </a>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Folio</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Articulos vendidos</th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td class="text-center">{{ $sale->id }}</td>
                                    <td class="text-right">
                                        ${{ number_format($sale->articles->sum(function($article){
                                            return $article->amount * $article->price;
                                        }),2,'.',',') }}
                                    </td>
                                    <td class="text-center">{{ $sale->articles->count() }}</td>
                                    <td class="text-center">{{ $sale->created_at->format('d/m/Y h:i:s') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('ticket', $sale->id) }}" 
                                                class="btn btn-xs btn-outline-dark ticket" target="_blank"
                                                title="Ver ticket">
                                                <i class="fa fa-file-text-o"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No hay ventas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pageScripts')
    <script>
        $(() => {
            var tickets = document.querySelectorAll('.ticket')
            tickets.forEach(ticket => {
                ticket.addEventListener('click', function(evt) {
                    evt.preventDefault()
                    evt.stopPropagation()
                    var url = ''
                    if (evt.target.tagName == 'A') {
                        url = evt.target.getAttribute('href')
                    } else if (evt.target.tagName == 'I') {
                        url = evt.target.parentNode.getAttribute('href')
                    }
                    window.open(url, '_blank', 'width=350,height=400')
                })
            });
        })
    </script>
@endsection