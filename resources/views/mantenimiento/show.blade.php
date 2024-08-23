@extends('tablar::page')

@section('title')
    Mantenimiento Detalle
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Detalles
                    </div>
                    <h2 class="page-title">
                        {{ __('Detalles del Mantenimiento') }}
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
                        <a href="{{ route('mantenimientos.edit', $mantenimiento->id) }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Icono de edición -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 12v6a3 3 0 0 0 3 3h12a3 3 0 0 0 3 -3v-6" />
                                <path d="M7 10l5 5l5 -5" />
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('mantenimientos.destroy', $mantenimiento->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="if(!confirm('¿Está seguro de que desea eliminar este mantenimiento?')){return false;}" class="btn btn-danger">
                                <!-- Icono de eliminar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l1 14a1 1 0 0 0 1 1h12a1 1 0 0 0 1 -1l1 -14" />
                                    <path d="M8 7v-4h8v4" />
                                    <path d="M9 10h6v10h-6z" />
                                </svg>
                                Eliminar
                            </button>
                        </form>
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
                    <h3 class="card-title">Detalles del Mantenimiento</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información del Mantenimiento</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Camión ID</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->camion_id }}</dd>

                                <dt class="col-sm-4">Tipo de Mantenimiento</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->tipoMantenimiento->nombre ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Fecha</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->fecha }}</dd>

                                <dt class="col-sm-4">Descripción</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->descripcion }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Camión</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Número de Placa</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->camion->numero_placa ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Modelo</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->camion->modelo ?? 'N/A' }}</dd>

                                <dt class="col-sm-4">Año</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->camion->año ?? 'N/A' }}</dd>
                                <dt class="col-sm-4">Descipcion</dt>
                                <dd class="col-sm-8">{{ $mantenimiento->camion->descripcion ?? 'N/A' }}</dd>

                                <!-- Agregar más detalles del camión si es necesario -->
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
