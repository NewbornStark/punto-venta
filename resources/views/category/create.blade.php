@extends('layouts/admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong>Crear categoría</strong>
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
                    <form action="{{ route('category.store') }}" method="POST" class="form-horizontal" enctype="application/x-www-form-urlencoded">
                        @include('category.form', ['btnText' => 'Guardar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection