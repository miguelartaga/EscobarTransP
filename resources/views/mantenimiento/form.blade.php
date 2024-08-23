<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('camion_id', 'Camión') }}</label>
    <div>
        {{ Form::select('camion_id', $camiones->pluck('id', 'id'), $mantenimiento->camion_id, ['class' => 'form-control' . ($errors->has('camion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un camión']) }}
        {!! $errors->first('camion_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el camión que será mantenido.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('tipo_mantenimiento_id', 'Tipo de Mantenimiento') }}</label>
    <div>
        {{ Form::select('tipo_mantenimiento_id', $tiposMantenimiento->pluck('nombre', 'id'), $mantenimiento->tipo_mantenimiento_id, ['class' => 'form-control' . ($errors->has('tipo_mantenimiento_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de mantenimiento']) }}
        {!! $errors->first('tipo_mantenimiento_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Seleccione el tipo de mantenimiento.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('fecha', 'Fecha') }}</label>
    <div>
        {{ Form::date('fecha', $mantenimiento->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione la fecha']) }}
        {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Ingrese la fecha del mantenimiento.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('mantenimientos.index') }}" class="btn btn-danger">Cancel</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
        </div>
    </div>
</div>
