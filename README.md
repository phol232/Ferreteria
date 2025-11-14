# SocioConstructor - Sistema de Gestión Empresarial

Sistema completo de gestión con Laravel (Backend) y Angular (Frontend).

## 🏗️ Arquitectura

- **Frontend**: Angular 18 → Desplegado en **Netlify**
- **Backend**: Laravel 11 API → Desplegado en **VPS con Docker**
- **Base de Datos**: MySQL 8.0 → En contenedor Docker

## 🚀 Despliegue en Producción

### Backend (VPS)

1. **Clonar el repositorio en tu VPS**
```bash
git clone <tu-repo>
cd TESIS_TOVAR
```

2. **Configurar variables de entorno**

Edita `proyectoSoftware/.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=ferreteria
DB_USERNAME=root
DB_PASSWORD=root123456
APP_ENV=production
APP_DEBUG=false
```

3. **Desplegar en producción**
```bash
chmod +x deploy-prod.sh
./deploy-prod.sh
```

**Consumo de recursos**: ~600MB-1GB RAM (Backend + MySQL optimizados)

### Frontend (Netlify)

1. **Sube el código a GitHub**
2. **Conecta tu repo en Netlify**
3. **Configuración**:
   - Base directory: `Frontend/SocioConstructor`
   - Build command: `npm run build`
   - Publish directory: `dist/socio-constructor/browser`
4. **Deploy**

Netlify detectará automáticamente el `netlify.toml`.

## 💻 Desarrollo Local

### Requisitos
- Docker Desktop
- Node.js 20+ (para desarrollo del frontend)

### Levantar el proyecto

```bash
# Backend + Base de datos
docker compose up -d

# Frontend (en otra terminal)
cd Frontend/SocioConstructor
npm install
npm start
```

**Acceso local**:
- Frontend: http://localhost:4200
- Backend API: http://localhost:8000/api
- MySQL: localhost:3306

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
