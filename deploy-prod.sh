#!/bin/bash

echo "🚀 Desplegando Backend en modo producción..."

# Detener contenedores de desarrollo
docker compose down

# Construir imágenes de producción (solo backend y MySQL)
echo "📦 Construyendo imágenes optimizadas..."
docker compose -f docker-compose.prod.yml build --no-cache backend

# Levantar en producción
echo "🔥 Levantando servicios..."
docker compose -f docker-compose.prod.yml up -d

# Esperar a que MySQL esté listo
echo "⏳ Esperando a MySQL..."
sleep 10

# Ejecutar migraciones
echo "🗄️  Ejecutando migraciones..."
docker compose -f docker-compose.prod.yml exec backend php artisan migrate --force

# Limpiar cache
echo "🧹 Limpiando cache..."
docker compose -f docker-compose.prod.yml exec backend php artisan config:cache
docker compose -f docker-compose.prod.yml exec backend php artisan route:cache
docker compose -f docker-compose.prod.yml exec backend php artisan view:cache

echo "✅ Despliegue completado!"
echo ""
echo "📊 Uso de recursos:"
docker stats --no-stream --format "table {{.Container}}\t{{.CPUPerc}}\t{{.MemUsage}}"
echo ""
echo "🌐 Backend API: https://sociobac.tecno-express.shop/api"
echo "📝 Ahora despliega el frontend en Vercel"
