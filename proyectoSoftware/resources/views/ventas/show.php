<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        h1 {
            color: #1e90ff; /* Azul */
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .detail {
            margin-bottom: 15px;
            font-size: 1.2em;
            color: #555;
        }
        .label {
            font-weight: bold;
            color: #f39c12; /* Amarillo */
        }
    </style>
</head>
<body>
    <h1>Detalles de la Venta</h1>
    <div class="container">
        <div class="detail">
            <span class="label">ID Venta:</span> 1
        </div>
        <div class="detail">
            <span class="label">Producto:</span> Martillo
        </div>
        <div class="detail">
            <span class="label">Cantidad:</span> 2
        </div>
        <div class="detail">
            <span class="label">Cliente:</span> Juan Pérez
        </div>
        <div class="detail">
            <span class="label">Fecha:</span> 2024-09-25
        </div>
        <div class="detail">
            <span class="label">Total:</span> $30.00
        </div>
    </div>
</body>
</html>
