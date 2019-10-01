@extends('layouts/admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Editar categoría</strong>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-12">
                    @if ($errors->any())
                        <div role="alert" class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('category.update', $category) }}" method="POST" class="form-horizontal" enctype="application/x-www-form-urlencoded">
                        @method('PATCH')
                        @include('category.form', ['btnText' => 'Actualizar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection