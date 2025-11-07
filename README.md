# SocioConstructor - Sistema de Gestión de Ferretería

Sistema completo de gestión para ferretería con Laravel (Backend) y Angular (Frontend).

## 🚀 Inicio Rápido con Docker

### Requisitos Previos
- Docker Desktop instalado
- Docker Compose v2

### Levantar el Proyecto

1. **Clonar el repositorio**
```bash
git clone <tu-repo>
cd TESIS_TOVAR
```

2. **Configurar variables de entorno (opcional)**

El proyecto ya viene con un `.env` configurado en `proyectoSoftware/.env`. Si necesitas cambiar las credenciales de la base de datos, edita ese archivo:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=ferreteria
DB_USERNAME=root
DB_PASSWORD=root123456
```

3. **Levantar los contenedores**
```bash
docker compose up
```

O en segundo plano:
```bash
docker compose up -d
```

4. **Acceder a las aplicaciones**
- **Frontend Angular**: http://localhost:4200
- **Backend Laravel**: http://localhost:8000
- **MySQL**: localhost:3306

### Comandos Útiles

```bash
# Ver logs en tiempo real
docker compose logs -f

# Ver logs de un servicio específico
docker compose logs -f backend
docker compose logs -f frontend

# Detener los contenedores
docker compose down

# Reconstruir las imágenes
docker compose build

# Reconstruir y levantar
docker compose up --build

# Ejecutar comandos en el backend
docker compose exec backend php artisan migrate
docker compose exec backend php artisan db:seed
```

## 📁 Estructura del Proyecto

```
.
├── Frontend/SocioConstructor/    # Aplicación Angular
├── proyectoSoftware/             # Aplicación Laravel
├── Database/                     # Scripts SQL iniciales
├── docker-compose.yml            # Configuración Docker
└── README.md
```

## 🔧 Desarrollo

### Hot Reload

El proyecto está configurado con hot-reload para desarrollo:

- **Laravel**: Los cambios en PHP se reflejan automáticamente
- **Angular**: Los cambios en TypeScript/HTML/CSS se recargan automáticamente (polling cada 2 segundos)

### Optimizaciones para Windows

El `docker-compose.yml` incluye optimizaciones específicas para Windows:
- Volúmenes separados para `vendor/` y `node_modules/`
- Modo `:cached` para mejor rendimiento
- Polling activado en Angular para detectar cambios

## 🗄️ Base de Datos

La base de datos se inicializa automáticamente con el esquema en `Database/scheme.sql`.

Para ejecutar migraciones manualmente:
```bash
docker compose exec backend php artisan migrate
```

Para ejecutar seeders:
```bash
docker compose exec backend php artisan db:seed
```

## 🛠️ Troubleshooting

### Puerto ocupado
Si algún puerto está ocupado, detén otros contenedores:
```bash
docker ps
docker stop <container_id>
```

### Limpiar volúmenes
Si necesitas empezar desde cero:
```bash
docker compose down -v
docker compose up --build
```

### Permisos en Linux
Si tienes problemas de permisos:
```bash
sudo chown -R $USER:$USER proyectoSoftware/storage
sudo chown -R $USER:$USER proyectoSoftware/bootstrap/cache
```

## 📝 Notas

- El archivo `.env` del backend NO se sube a GitHub por seguridad
- Copia `.env.example` a `.env` si no existe
- Las credenciales por defecto son para desarrollo, cámbialas en producción
