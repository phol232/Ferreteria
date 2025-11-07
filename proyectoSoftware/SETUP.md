# Setup del Backend Laravel

## Pasos para configurar el backend

### 1. Importar la base de datos
Primero asegúrate de tener MySQL corriendo en tu máquina local y ejecuta:
```bash
mysql -u root -p < Database/scheme.sql
```
O importa el archivo `Database/scheme.sql` usando tu cliente MySQL favorito.

### 2. Levantar el contenedor Docker
```bash
cd proyectoSoftware
docker-compose up -d
```

### 3. Instalar dependencias de Composer (si es necesario)
```bash
docker exec -it laravel_app composer install
```

### 4. Verificar que el backend esté corriendo
El backend estará disponible en: `http://localhost:8000`

Prueba con: `http://localhost:8000/api/productos`

## Endpoints API disponibles

### Productos
- `GET /api/productos` - Listar todos los productos
- `GET /api/productos/{id}` - Ver un producto
- `POST /api/productos` - Crear producto
- `PUT /api/productos/{id}` - Actualizar producto
- `DELETE /api/productos/{id}` - Eliminar producto

### Clientes
- `GET /api/clientes` - Listar todos los clientes
- `GET /api/clientes/{id}` - Ver un cliente
- `POST /api/clientes` - Crear cliente
- `PUT /api/clientes/{id}` - Actualizar cliente
- `DELETE /api/clientes/{id}` - Eliminar cliente

### Proveedores
- `GET /api/proveedores` - Listar todos los proveedores
- `GET /api/proveedores/{id}` - Ver un proveedor
- `POST /api/proveedores` - Crear proveedor
- `PUT /api/proveedores/{id}` - Actualizar proveedor
- `DELETE /api/proveedores/{id}` - Eliminar proveedor

### Ventas
- `GET /api/ventas` - Listar todas las ventas (con detalles)
- `GET /api/ventas/{id}` - Ver una venta con sus detalles
- `POST /api/ventas` - Crear venta (incluye detalles y actualiza stock)
- `PUT /api/ventas/{id}` - Actualizar venta
- `DELETE /api/ventas/{id}` - Eliminar venta (restaura stock)

## Notas importantes

- La base de datos MySQL debe estar corriendo en `localhost:3306`
- Credenciales: usuario `root`, password `root123456`, base de datos `ferreteria`
- Al crear una venta, el stock de productos se actualiza automáticamente
- Al eliminar una venta, el stock se restaura
