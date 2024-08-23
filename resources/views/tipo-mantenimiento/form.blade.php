<div class="form-group mb-3">
    <label class="form-label" for="nombre">{{ Form::label('nombre', 'Nombre') }}</label>
    <div>
        {{ Form::text('nombre', old('nombre', $tipoMantenimiento->nombre), [
            'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
            'placeholder' => 'Nombre'
        ]) }}
        {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">tipoMantenimiento <b>nombre</b> instruction.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('tipo-mantenimientos.index') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>
