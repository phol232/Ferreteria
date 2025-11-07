<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
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
            max-width: 400px;
        }
        h1 {
            text-align: center;
            color: #1e90ff; /* Azul */
            text-transform: uppercase;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-size: 1em;
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
            background-color: #e67e22; /* Amarillo más oscuro */
        }
        input:focus {
            border-color: #1e90ff; /* Azul */
            outline: none;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            input[type="text"], input[type="number"] {
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Actualizar Producto</h1>
        <form action="/almacen/update" method="POST">
            @csrf
            @method('PUT') <!-- Laravel method spoofing -->
            
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="{{ $producto->nombre ?? 'Producto X' }}" required>

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="{{ $producto->precio ?? '100.00' }}" required>

            <label for="stock">Cantidad en Stock:</label>
            <input type="number" id="stock" name="stock" value="{{ $producto->stock ?? '50' }}" required>

            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria" value="{{ $producto->categoria ?? 'Herramientas' }}" required>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
