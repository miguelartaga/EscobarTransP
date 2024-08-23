<div class="form-group mb-3">
    <label class="form-label" for="lugar_inicio_id">Lugar Inicio</label>
    <select name="lugar_inicio_id" id="lugar_inicio_id" class="form-control {{ $errors->has('lugar_inicio_id') ? 'is-invalid' : '' }}">
        <option value="">Select Lugar Inicio</option>
        @foreach($lugares as $id => $nombre)
            <option value="{{ $id }}" {{ old('lugar_inicio_id', isset($destino) ? $destino->lugar_inicio_id : '') == $id ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('lugar_inicio_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    <label class="form-label" for="lugar_final_id">Lugar Final</label>
    <select name="lugar_final_id" id="lugar_final_id" class="form-control {{ $errors->has('lugar_final_id') ? 'is-invalid' : '' }}">
        <option value="">Select Lugar Destino</option>
        @foreach($lugares as $id => $nombre)
            <option value="{{ $id }}" {{ old('lugar_final_id', isset($destino) ? $destino->lugar_final_id : '') == $id ? 'selected' : '' }}>
                {{ $nombre }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('lugar_final_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div class="form-group mb-3">
    <label class="form-label" for="kilometros">Kilómetros</label>
    <input type="text" name="kilometros" id="kilometros" class="form-control {{ $errors->has('kilometros') ? 'is-invalid' : '' }}" placeholder="Kilómetros" value="{{ old('kilometros', isset($destino) ? $destino->kilometros : '') }}">
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
