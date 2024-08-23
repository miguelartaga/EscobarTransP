<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            float: left;
        }
        .title {
            text-align: right;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            <!-- Aquí va el logotipo -->
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100">
        </div>
        <div class="title">
            <h1>Factura de Transporte</h1>
        </div>
    </div>

    <div class="customer-info">
        <p><strong>Cliente:</strong> {{ $factura->cliente_nombre }}</p>
        <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Camión N° Placa</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Carga</th>
                <th>Código de Boleta</th>
                <th>Peso en (TN)</th>
                <th>Precio</th>
                <th>Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $factura->camion_placa }}</td>
                <td>{{ $factura->destino }}</td>
                <td>{{ $factura->fecha }}</td>
                <td>{{ $factura->carga }}</td>
                <td>{{ $factura->codigo_boleta }}</td>
                <td>{{ $factura->peso_tn }}</td>
                <td>{{ $factura->precio }}</td>
                <td>{{ $factura->precio_total }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
