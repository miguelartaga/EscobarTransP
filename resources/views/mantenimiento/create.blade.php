@extends('tablar::page')

@section('title', 'Create Mantenimiento')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Create
                    </div>
                    <h2 class="page-title">
                        {{ __('Mantenimiento') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Mantenimiento List
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
                            <h3 class="card-title">Mantenimiento Details</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('mantenimientos.store') }}" id="ajaxForm" role="form"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="camion_id" class="form-label">Camión</label>
                                    <select name="camion_id" id="camion_id" class="form-select">
                                        @foreach ($camiones as $camion)
                                            <option value="{{ $camion->numero_placa }}">{{ $camion->numero_placa }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="tipo_mantenimiento_id" class="form-label">Tipo de Mantenimiento</label>
                                    <select name="tipo_mantenimiento_id" id="tipo_mantenimiento_id" class="form-select">
                                        @foreach ($tiposMantenimientos as $tipoMantenimiento)
                                            <option value="{{ $tipoMantenimiento->id }}">{{ $tipoMantenimiento->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control"
                                        value="{{ old('fecha') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea name="descripcion" id="descripcion" class="form-control" rows="4"
                                        required>{{ old('descripcion') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
