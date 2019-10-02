@extends('layouts/admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('articles.create') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Nuevo articulo
                </a>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-12">
                    <table class="table table-responsive-sm table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Sku</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($articles as $article)
                                <tr>
                                    <td>{{ $article->name }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td class="text-center">{{ $article->sku }}</td>
                                    <td class="text-right">${{ $article->price }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('articles.edit', $article) }}" class="btn btn-xs btn-outline-warning">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                class="btn btn-xs btn-outline-danger del-article"
                                                data-id="{{ $article->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('articles.destroy', $article) }}" 
                                            class="d-none"
                                            id="frmDel{{$article->id}}">
                                            @csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No hay articulos registrados</td>
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
    <script src="{{ asset('js/articles/index.js') }}"></script>
@endsection