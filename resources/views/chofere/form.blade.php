<div class="form-group mb-3">
    <label class="form-label" for="nombre">{{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', old('nombre', $chofere->nombre), [
            'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
            'placeholder' => 'Nombre',
            'id' => 'nombre'
        ]) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">chofere <b>nombre</b> instruction.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="licencia">{{ Form::label('licencia') }}</label>
    <div>
        {{ Form::text('licencia', old('licencia', $chofere->licencia), [
            'class' => 'form-control' . ($errors->has('licencia') ? ' is-invalid' : ''),
            'placeholder' => 'Licencia',
            'id' => 'licencia'
        ]) }}
        {!! $errors->first('licencia', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">chofere <b>licencia</b> instruction.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="carnet_identidad">{{ Form::label('carnet_identidad') }}</label>
    <div>
        {{ Form::text('carnet_identidad', old('carnet_identidad', $chofere->carnet_identidad), [
            'class' => 'form-control' . ($errors->has('carnet_identidad') ? ' is-invalid' : ''),
            'placeholder' => 'Carnet Identidad',
            'id' => 'carnet_identidad'
        ]) }}
        {!! $errors->first('carnet_identidad', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">chofere <b>carnet_identidad</b> instruction.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label" for="licencia_file">{{ Form::label('licencia_file', 'Licencia File') }}</label>
    <div>
        {{ Form::file('licencia_file', [
            'class' => 'form-control' . ($errors->has('licencia_file') ? ' is-invalid' : ''),
            'id' => 'licencia_file'
        ]) }}
        {!! $errors->first('licencia_file', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Upload a file for <b>licencia</b>.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('choferes.index') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>
