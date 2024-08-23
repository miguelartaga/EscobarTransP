@extends('tablar::page')

@section('title')
    Show Lugar
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Show
                    </div>
                    <h2 class="page-title">
                        {{ __('Show Lugar') }}
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
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Lugar Details</h3>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <p class="form-control-plaintext">{{ $lugar->nombre }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
