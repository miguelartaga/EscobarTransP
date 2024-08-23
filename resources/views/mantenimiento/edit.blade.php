@extends('tablar::page')

@section('title')
    Editar Mantenimiento
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Editar
                    </div>
                    <h2 class="page-title">
                        {{ __('Editar Mantenimiento') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('mantenimientos.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Icono de regresar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <polyline points="15 6 9 12 15 18" />
                            </svg>
                            Regresar a la lista
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
                <div class="card-header">
                    <h3 class="card-title">Editar Mantenimiento</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('mantenimientos.update', $mantenimiento->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="camion_id" class="form-label">Camión</label>
                            <input type="text" id="camion_id" class="form-control" value="{{ $mantenimiento->camion->numero_placa }} - {{ $mantenimiento->camion->marca }} {{ $mantenimiento->camion->modelo }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="tipo_mantenimiento_id" class="form-label">Tipo de Mantenimiento</label>
                            <input type="text" id="tipo_mantenimiento_id" class="form-control" value="{{ $mantenimiento->tipoMantenimiento->nombre }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" id="fecha" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', $mantenimiento->fecha) }}">
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea id="descripcion" name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2">Guardar Cambios</button>
                            <a href="{{ route('mantenimientos.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
