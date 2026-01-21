#!/bin/bash

echo "🚀 Iniciando proyecto ECOCE WordPress en local..."
echo ""

# Verificar MySQL
echo "🔍 Verificando MySQL..."
if ! mysql -u root -e "SELECT 1;" &>/dev/null; then
    echo "⚠️  MySQL no está corriendo. Intentando iniciarlo..."
    
    # Intentar iniciar MySQL con diferentes métodos
    if command -v brew &>/dev/null; then
        brew services start mysql 2>/dev/null || brew services start mariadb 2>/dev/null || true
        sleep 3
    fi
    
    # Verificar nuevamente
    if ! mysql -u root -e "SELECT 1;" &>/dev/null; then
        echo "❌ MySQL no está corriendo. Por favor, inicia MySQL manualmente:"
        echo "   brew services start mysql"
        echo "   O si usas MariaDB:"
        echo "   brew services start mariadb"
        echo ""
        echo "Luego ejecuta este script nuevamente."
        exit 1
    fi
fi

echo "✅ MySQL está corriendo"
echo ""

# Verificar si la base de datos existe
if ! mysql -u root -e "USE ecoce_wp;" &>/dev/null; then
    echo "📦 Creando base de datos..."
    mysql -u root -e "CREATE DATABASE IF NOT EXISTS ecoce_wp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
    
    if [ -f "backup-2026-01-06_19-35-24.sql" ]; then
        echo "📥 Importando base de datos (esto puede tardar varios minutos)..."
        mysql -u root ecoce_wp < backup-2026-01-06_19-35-24.sql
        
        if [ $? -eq 0 ]; then
            echo "✅ Base de datos importada"
            
            # Actualizar URLs
            echo "🔄 Actualizando URLs del sitio..."
            mysql -u root ecoce_wp -e "UPDATE wp_options SET option_value = 'http://localhost:8000' WHERE option_name = 'siteurl'; UPDATE wp_options SET option_value = 'http://localhost:8000' WHERE option_name = 'home';" 2>/dev/null
            echo "✅ URLs actualizadas a http://localhost:8000"
        else
            echo "⚠️  Error al importar la base de datos"
        fi
    else
        echo "⚠️  No se encontró el archivo backup-2026-01-06_19-35-24.sql"
    fi
else
    echo "✅ Base de datos 'ecoce_wp' ya existe"
fi

echo ""
echo "🌐 Iniciando servidor PHP en http://localhost:8000"
echo "   Presiona Ctrl+C para detener el servidor"
echo ""
echo "🔐 Acceso al panel de administración:"
echo "   http://localhost:8000/iniciar-sesion/"
echo ""

# Iniciar servidor PHP
php -S localhost:8000
