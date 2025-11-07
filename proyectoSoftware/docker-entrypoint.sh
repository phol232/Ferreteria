#!/bin/bash
set -e

echo "🚀 Starting Laravel Backend..."

# Crear directorios necesarios con permisos correctos
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Dar permisos de escritura
chmod -R 775 storage bootstrap/cache

# Instalar dependencias si no existen
if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    echo "📦 Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader --no-cache
fi

# Limpiar cache para desarrollo
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan route:clear || true
php artisan cache:clear || true

# Ejecutar migraciones
echo "🗄️  Running migrations..."
php artisan migrate --force || echo "⚠️  Migrations failed, continuing..."

# Iniciar servidor
echo "✅ Starting Laravel development server on port 8000..."
php artisan serve --host=0.0.0.0 --port=8000
