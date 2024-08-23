@extends('tablar::page')

@section('title')
    Edit Lugar
@endsection

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Edit
                    </div>
                    <h2 class="page-title">
                        {{ __('Edit Destino') }}
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-12 col-md-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('destinos.index') }}" class="btn btn-primary d-none d-sm-inline-block">
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
                    <form action="{{ route('destinos.update', $destino->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label" for="lugar_inicio_id">Lugar Inicio</label>
                            <select name="lugar_inicio_id" id="lugar_inicio_id" class="form-control {{ $errors->has('lugar_inicio_id') ? 'is-invalid' : '' }}">
                                <option value="">Select Lugar Inicio</option>
                                @foreach($lugares as $id => $nombre)
                                    <option value="{{ $id }}" {{ old('lugar_inicio_id', $destino->lugar_inicio_id) == $id ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('lugar_inicio_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="lugar_final_id">Lugar Destino</label>
                            <select name="lugar_final_id" id="lugar_final_id" class="form-control {{ $errors->has('lugar_final_id') ? 'is-invalid' : '' }}">
                                <option value="">Select Lugar Final</option>
                                @foreach($lugares as $id => $nombre)
                                    <option value="{{ $id }}" {{ old('lugar_final_id', $destino->lugar_final_id) == $id ? 'selected' : '' }}>
                                        {{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                            {!! $errors->first('lugar_final_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="kilometros">Kilómetros</label>
                            <input type="text" name="kilometros" id="kilometros" class="form-control {{ $errors->has('kilometros') ? 'is-invalid' : '' }}" placeholder="Kilómetros" value="{{ old('kilometros', $destino->kilometros) }}">
                            {!! $errors->first('kilometros', '<div class="invalid-feedback">:message</div>') !!}
                        </div>

                        <div class="form-footer">
                            <div class="text-end">
                                <div class="d-flex">
                                    <a href="{{ route('destinos.index') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
