@extends('tablar::page')

@section('title', 'Update Tipo Mantenimiento')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Update
                    </div>
                    <h2 class="page-title">
                        {{ __('Tipo Mantenimiento ') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('tipo-mantenimientos.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Tipo Mantenimiento List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if (config('tablar', 'display_alert'))
                @include('tablar::common.alert')
            @endif
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tipo Mantenimiento Details</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('tipo-mantenimientos.update', $tipoMantenimiento->id) }}"
                                id="ajaxForm" role="form" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" id="nombre" name="nombre" value="{{ old('nombre', $tipoMantenimiento->nombre) }}" placeholder="Nombre">
                                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                    <small class="form-hint">Tipo Mantenimiento <b>nombre</b> instruction.</small>
                                </div>
                                <div class="form-footer">
                                    <div class="text-end">
                                        <div class="d-flex">
                                            <a href="{{ route('tipo-mantenimientos.index') }}" class="btn btn-danger">Cancel</a>
                                            <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
