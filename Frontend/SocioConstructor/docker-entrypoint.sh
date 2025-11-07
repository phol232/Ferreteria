#!/bin/sh
set -e

echo "🚀 Starting Angular Frontend..."

# Instalar dependencias si no existen
if [ ! -d "node_modules" ] || [ ! -f "node_modules/.package-lock.json" ]; then
    echo "📦 Installing npm dependencies..."
    npm install
fi

# Iniciar servidor de desarrollo
echo "✅ Starting Angular development server on port 4200..."
npm start -- --host 0.0.0.0 --poll 2000
