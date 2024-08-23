<div class="mb-3">
    <label for="numero_placa" class="form-label">Número de Placa</label>
    <input type="text" name="numero_placa" class="form-control" value="{{ old('numero_placa', $camion->numero_placa) }}" required>
</div>
<div class="mb-3">
    <label for="modelo" class="form-label">Modelo</label>
    <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $camion->modelo) }}" required>
</div>
<div class="mb-3">
    <label for="año" class="form-label">Año</label>
    <input type="text" name="año" class="form-control" value="{{ old('año', $camion->año) }}" required>
</div>
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control">{{ old('descripcion', $camion->descripcion) }}</textarea>
</div>
<div class="mb-3">
    <label for="proximo_cambio_aceite" class="form-label">Kilometraje en (KM)</label>
    <input type="number" name="proximo_cambio_aceite" class="form-control" value="{{ old('proximo_cambio_aceite', $camion->proximo_cambio_aceite) }}" required>
</div>


<div class="mb-3">
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>
