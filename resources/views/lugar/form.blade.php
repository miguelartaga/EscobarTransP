@extends('tablar::page')

@section('title')
    {{ $modo }} Lugar
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        {{ $modo }}
                    </div>
                    <h2 class="page-title">
                        {{ $modo }} Lugar
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('lugares.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @include('tablar::common.alert')
            <div class="card">
                <div class="card-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($modo === 'Edit')
                            @method('PUT')
                        @endif
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $lugar->nombre ?? '') }}">
                            @error('nombre')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ $modo }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
