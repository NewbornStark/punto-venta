@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i> Nueva categoría
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
                                <th>Nombre</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('category.edit', $category) }}" class="btn btn-xs btn-outline-warning">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" 
                                                class="btn btn-xs btn-outline-danger del-category"
                                                data-id="{{ $category->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('category.destroy', $category) }}" 
                                            class="d-none"
                                            id="frmDel{{$category->id}}">
                                            @csrf @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="2">No hay articulos registrados</td>
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
    <script src="{{ asset('js/category/index.js') }}"></script>
@endsection