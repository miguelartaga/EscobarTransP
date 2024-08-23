@extends('tablar::page')

@section('title', 'Ruta')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        List
                    </div>
                    <h2 class="page-title">
                        {{ __('Rutas') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('rutas.create') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Icono para añadir -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Crear Ruta
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
                            <h3 class="card-title">Lista de Rutas</h3>
                        </div>

                        <div class="card-body border-bottom py-3">
                            <!-- Formulario para seleccionar rutas y generar factura -->
                            <form action="{{ route('rutas.generateInvoice') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="cliente_nombre" class="form-label">Nombre del Cliente:</label>
                                    <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre"
                                        required>
                                </div>

                                <div class="table-responsive min-vh-100">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="w-1"><input class="form-check-input m-0 align-middle"
                                                        type="checkbox" id="select-all"></th>
                                                <th class="w-1">No.</th>
                                                <th>Camión Número Placa</th>
                                                <th>Chofer Id</th>
                                                <th>Destino Id</th>
                                                <th>Fecha Fin</th>
                                                <th>Carga</th>
                                                <th>Código de Boleta</th>
                                                <th>Peso (TN)</th>
                                                <th>Precio</th>
                                                <th>Precio Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($rutas as $ruta)
                                                <tr>
                                                    <td><input class="form-check-input m-0 align-middle" type="checkbox"
                                                            name="rutas[]" value="{{ $ruta->id }}"></td>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $ruta->camion_numero_placa }}</td>
                                                    <td>{{ $ruta->chofer_id }}</td>
                                                    <td>{{ $ruta->destino_id }}</td>
                                                    <td>{{ $ruta->fecha_fin }}</td>
                                                    <td>{{ $ruta->carga }}</td>
                                                    <td>{{ $ruta->codigo_de_pago }}</td>
                                                    <td>{{ $ruta->peso }}</td>
                                                    <td>{{ $ruta->precio }}</td>
                                                    <td>{{ $ruta->precio_total }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="11" class="text-center">No hay datos disponibles</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer d-flex justify-content-between align-items-center">
                                    {!! $rutas->links('tablar::pagination') !!}
                                    <button type="submit" class="btn btn-success">Generar Factura</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.querySelectorAll('input[name="rutas[]"]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
