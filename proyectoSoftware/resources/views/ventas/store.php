<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Venta</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        button {
            background-color: #f39c12; /* Amarillo */
            color: white;
            padding: 10px;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e67e22; /* Un tono más oscuro de amarillo al pasar el mouse */
        }
        input:focus {
            border-color: #1e90ff; /* Azul */
            outline: none;
        }
    </style>
</head>
<body>
    <h1>Guardar Venta</h1>
    <div class="container">
        <form action="/ventas/store" method="POST">
            <label for="producto">Producto:</label>
            <input type="text" id="producto" name="producto" required>

            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>

            <label for="cliente">Cliente:</label>
            <input type="text" id="cliente" name="cliente" required>

            <button type="submit">Registrar Venta</button>
        </form>
    </div>
</body>
</html>
