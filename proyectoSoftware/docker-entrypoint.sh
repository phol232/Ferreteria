#!/bin/bash
set -e

echo "🚀 Starting Laravel Backend..."

# Instalar dependencias si no existen
if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    echo "📦 Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

# Limpiar cache para desarrollo
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan cache:clear

# Ejecutar migraciones
echo "🗄️  Running migrations..."
php artisan migrate --force

# Iniciar servidor
echo "✅ Starting Laravel development server on port 8000..."
php artisan serve --host=0.0.0.0 --port=8000
