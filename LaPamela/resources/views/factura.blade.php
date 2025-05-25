<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h1>La Pamela - Factura</h1>
    <p>Cliente: {{ $cliente['nombre'] }}</p>
    <p>Email: {{ $cliente['email'] }}</p>
    <p>Dirección: {{ $cliente['direccion'] }}</p>

    <h3>Resumen del pedido:</h3>
    <table>
        <thead>
            <tr><th>Producto</th><th>Cantidad</th><th>Precio</th></tr>
        </thead>
        <tbody>
            @foreach ($cliente['carrito'] as $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>{{ $item['cantidad'] }}</td>
                    <td>{{ number_format($item['precio'], 2) }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Total: {{ number_format($total, 2) }} €</h3>
</body>
</html>
