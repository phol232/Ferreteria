<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
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
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Ensures the container doesn't exceed 400px */
            text-align: center;
        }
        h1 {
            color: #1e90ff; /* Azul */
            text-transform: uppercase;
        }
        p {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }
        .label {
            font-weight: bold;
            color: #f39c12; /* Amarillo */
        }
        .btn {
            background-color: #1e90ff; /* Azul */
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #005bb5; /* Azul más oscuro */
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalles del Producto</h1>
        <p><span class="label">Nombre:</span> Producto X</p>
        <p><span class="label">Precio:</span> $100.00</p>
        <p><span class="label">Cantidad en Stock:</span> 20 unidades</p>
        <p><span class="label">Categoría:</span> Herramientas</p>
        <a href="/almacen/edit/1" class="btn">Editar Producto</a>
    </div>
</body>
</html>
