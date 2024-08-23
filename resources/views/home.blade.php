@extends('tablar::page')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Overview</div>
                    <h2 class="page-title">Dashboard</h2>
                </div>
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- Botones adicionales, si es necesario -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Camiones</h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex">
                                <div class="text-muted">
                                    Show
                                    <div class="mx-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm" value="{{ $camiones->perPage() }}"
                                            size="3" aria-label="Camiones count">
                                    </div>
                                    entries
                                </div>
                                <div class="ms-auto text-muted">
                                    Search:
                                    <div class="ms-2 d-inline-block">
                                        <input type="text" class="form-control form-control-sm"
                                            aria-label="Search camiones">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap datatable">
                                <thead>
                                    <tr>
                                        <th class="w-1">No.</th>
                                        <th>Numero Placa</th>
                                        <th>Modelo</th>
                                        <th>Año</th>
                                        <th>Descripción</th>
                                        <th>Proximo Cambio Aceite</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($camiones as $camion)
                                        @php
                                            $badgeClass = 'bg-success'; // Default color
                                            $badgeText = 'Recien Cambiado'; // Default text

                                            if ($camion->proximo_cambio_aceite > 3000 && $camion->proximo_cambio_aceite <= 4999) {
                                                $badgeClass = 'bg-warning';
                                                $badgeText = 'Ojito';
                                            } elseif ($camion->proximo_cambio_aceite > 4999) {
                                                $badgeClass = 'bg-danger';
                                                $badgeText = 'Ya Toca';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $camion->numero_placa }}</td>
                                            <td>{{ $camion->modelo }}</td>
                                            <td>{{ $camion->año }}</td>
                                            <td>{{ $camion->descripcion }}</td>
                                            <td>
                                                <span class="badge {{ $badgeClass }}" style="color: black;">{{ $badgeText }}</span>
                                                {{ $camion->proximo_cambio_aceite }} km
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex align-items-center">
                            <p class="m-0 text-muted">Showing <span>{{ $camiones->firstItem() }}</span> to <span>{{ $camiones->lastItem() }}</span> of <span>{{ $camiones->total() }}</span> entries</p>
                            {{ $camiones->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
