@extends('tablar::page')

@section('title', 'Update Chofere')

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
                        {{ __('Chofere') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('choferes.index') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Chofere List
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
                            <h3 class="card-title">Chofere Details</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('choferes.update', $chofere->id) }}" id="ajaxForm"
                                role="form" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $chofere->nombre }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="ci" class="form-label">Carnet Identidad</label>
                                    <input type="text" class="form-control" id="ci" name="ci" value="{{ $chofere->ci }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="direccion" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $chofere->direccion }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="numero_referencia" class="form-label">Número de Referencia</label>
                                    <input type="text" class="form-control" id="numero_referencia" name="numero_referencia" value="{{ $chofere->numero_referencia }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="numero_referencia_segundo" class="form-label">Segundo Número de Referencia</label>
                                    <input type="text" class="form-control" id="numero_referencia_segundo" name="numero_referencia_segundo" value="{{ $chofere->numero_referencia_segundo }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="licencia" class="form-label">Foto de la Licencia</label>
                                    <input type="file" class="form-control" id="licencia" name="licencia">
                                    @if($chofere->licencia)
                                        <small class="form-text text-muted">Imagen actual:</small>
                                        <img src="{{ asset('storage/' . $chofere->licencia) }}" alt="Licencia" style="width: 100px; height: auto;">
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                    <a href="{{ route('choferes.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
