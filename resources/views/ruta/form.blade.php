@extends('tablar::page')

@section('title', 'Crear/Editar Ruta')

@section('content')
    <!-- Contenido del formulario -->
    <form action="{{ route('rutas.store') }}" method="POST">
        @csrf
        <!-- Aquí va todo el contenido del formulario que ya tienes -->

        <div class="form-group">
            <label for="destino_id">Destino</label>
            <select name="destino_id" id="destino_id" class="form-control">
                @foreach ($destinos as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="camion_numero_placa">Camión</label>
            <select name="camion_numero_placa" id="camion_numero_placa" class="form-control">
                @foreach ($camiones as $numero_placa)
                    <option value="{{ $numero_placa }}">{{ $numero_placa }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="chofer_id">Chofer</label>
            <select name="chofer_id" id="chofer_id" class="form-control">
                @foreach ($choferes as $id => $nombre)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
        </div>

        <div class="form-group">
            <label for="carga">Carga</label>
            <input type="text" name="carga" id="carga" class="form-control" value="{{ old('carga') }}"
                placeholder="Ingresa el tipo de Carga">
        </div>

        <div class="form-group">
            <label for="codigo_de_pago">Codigo de Boleta</label>
            <input type="text" name="codigo_de_pago" id="codigo_de_pago" class="form-control"
                value="{{ old('codigo_de_pago') }}" placeholder="Ingresa el Codigo de Boleta">
        </div>

        <div class="form-group">
            <label for="peso">Peso</label>
            <input type="text" name="peso" id="peso" class="form-control" value="{{ old('peso') }}"
                placeholder="Ingresa el peso en kilogramos" oninput="calcularPrecioTotal()">
        </div>

        <div class="form-group">
            <label for="precio">Precio por kg</label>
            <input type="text" name="precio" id="precio" class="form-control" value="{{ old('precio') }}"
                placeholder="Ingrese precio por kilogramo" oninput="calcularPrecioTotal()">
        </div>

        <div class="form-group">
            <label for="precio_total">Precio Total</label>
            <input type="text" name="precio_total" id="precio_total" class="form-control"
                value="{{ old('precio_total') }}" readonly>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    <!-- Aquí es donde se coloca el script de JavaScript -->
    <script>
        function calcularPrecioTotal() {
            // Obtener valores de peso y precio
            let peso = document.getElementById('peso').value;
            let precio = document.getElementById('precio').value;

            // Convertir a números (si son válidos)
            peso = parseFloat(peso) || 0;
            precio = parseFloat(precio) || 0;

            // Calcular el precio total
            let precioTotal = peso * precio;

            // Asignar el precio total al campo correspondiente
            document.getElementById('precio_total').value = precioTotal.toFixed(2);
        }
    </script>
@endsection
