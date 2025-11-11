# ECOCE Rediseño — Proyecto WordPress

Guía de instalación, configuración y operación del proyecto WordPress para ECOCE.

---

## 1. Información general

- Nombre del proyecto: ECOCE Rediseño
- Descripción: Sitio corporativo informativo, gestionado con WordPress + Elementor.
- Acceso al panel: `https://demo.ecoce.mx/iniciar-sesion/` (personalizado con WPS Hide Login)
- Entorno: Servidor temporal de pruebas; el cliente migrará a AWS.

## 2. Requisitos del sistema

- WordPress: `6.8.3`
- PHP: `8.4.x` (validado en `8.4.7`)
- MySQL: `8.0.x` (validado en `8.0.43`)
- Servidor web: Nginx `1.18.0`
- Recursos sugeridos: 2 vCPU, 4 GB RAM, 120 GB SSD
- Parámetros PHP recomendados:
  - `memory_limit = 128M`
  - `upload_max_filesize = 64M`
  - `post_max_size = 64M`
  - `max_execution_time = 30`
  - Extensiones habituales (no exhaustivo): `curl`, `json`, `mbstring`, `openssl`, `pdo_mysql`, `zip`

## 3. Accesos y licencias

- El acceso SSH y credenciales se proporcionan al momento de la transferencia.
- No hay cPanel/Plesk/FTP; gestión vía SSH.
- No hay phpMyAdmin; la BD se opera con MySQL CLI.
- Elementor Pro requiere licencia activa (verificar con el cliente para el nuevo ambiente).

## 4. Copia del sitio y base de datos

- El repositorio entrega: archivos completos de WordPress y un dump de la base de datos.
- Estructura de medios: estándar en `wp-content/uploads/<año>/<mes>`.

---

## 5. Manual de instalación

1) Preparar entorno
   - Instalar Nginx, PHP-FPM (`8.4`) y MySQL (`8.0`).
   - Crear una base de datos y usuario con permisos completos.

2) Obtener el proyecto
   - Clonar o descargar este repositorio en el directorio del servidor (por ejemplo `/var/www/ecoce`).

3) Importar la base de datos
   - Ubicar el dump SQL provisto en el repositorio.
   - Importar con MySQL CLI: `mysql -u <usuario> -p <nombre_bd> < dump.sql`.

4) Configurar `wp-config.php`
   - Ajustar `DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`.
   - Actualizar claves/`AUTH_KEY` y salts (opcional pero recomendado) desde https://api.wordpress.org/secret-key/1.1/salt/.

5) Ajuste de URLs
   - Si el dominio destino cambia, realizar `search-replace` con WP‑CLI:
     - `wp search-replace 'https://demo.ecoce.mx' 'https://tu-dominio.com' --all-tables --precise`
   - Alternativamente, ajustar `siteurl` y `home` en la tabla `wp_options`.

6) Permisos de archivos
   - Establecer propietario del árbol del sitio al usuario de ejecución de PHP/Nginx.
   - Ejemplo (Ubuntu): `sudo chown -R www-data:www-data /var/www/ecoce`
   - Permisos típicos: `find . -type d -exec chmod 755 {} \; && find . -type f -exec chmod 644 {} \;`

7) Configurar Nginx (ver sección siguiente) y reiniciar servicios
   - Recargar Nginx y PHP-FPM tras aplicar cambios.

---

## 6. Configuración de Nginx (ejemplo)

Archivo de sitio sugerido (Ubuntu/Debian): `/etc/nginx/sites-available/ecoce`

```nginx
server {
    listen 80;
    server_name tu-dominio.com;

    root /var/www/ecoce;
    index index.php index.html index.htm;

    # Redirecciones básicas y seguridad
    client_max_body_size 64M;

    # Manejo de permalinks de WordPress
    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    # Archivos estáticos
    location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|webp|ttf|woff|woff2)$ {
        expires 30d;
        add_header Cache-Control "public, max-age=2592000";
    }

    # PHP via PHP-FPM 8.4
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;  # Ajustar según sistema
        fastcgi_read_timeout 60s;
    }

    # Denegar acceso a archivos sensibles
    location ~* /\.(ht|git|env|composer|npm) {
        deny all;
    }
}
```

Notas:
- Este proyecto usa Nginx; no hay `.htaccess`.
- Ajustar `server_name`, `root` y el socket de `php8.4-fpm` a tu entorno.

---

## 7. Tema y plantillas

- Tema activo: `Hello Elementor` (v. 3.4.5). Tema base de Elementor, sin child theme.
- Plantillas y estructura:
  - La maquetación se gestiona con Elementor/Elementor Pro (Theme Builder).
  - Habitualmente incluye plantillas de Encabezado (Header), Pie (Footer), Página (Single/Pages), Archivos (Archive).
  - Edición: WordPress Admin → `Plantillas` / `Templates` → Elementor Theme Builder.
  - No hay personalizaciones de código en el tema; el diseño se administra íntegramente en Elementor.

---

## 8. Plugins instalados y qué hace cada uno

Plugins activos:
- `Elementor` (3.33.0): Constructor visual drag‑and‑drop para crear páginas y bloques.
- `Elementor Pro` (3.33.0, licencia): Extiende Elementor con Theme Builder, Widgets Pro, Forms, etc.
- `MapSVG Lite` (8.7.19): Mapas vectoriales y marcadores interactivos en páginas y entradas.
- `WPS Hide Login` (1.9.17.2): Cambia la URL de acceso (`/wp-login.php`) a una personalizada; aquí `iniciar-sesion`.
- `Coming Soon and Maintenance by Colorlib` (1.1.2): Activa modo mantenimiento/coming soon para visitantes no autenticados.

Plugins inactivos:
- `Simple CAPTCHA Alternative with Cloudflare Turnstile` (1.35.0): Protección anti‑spam mediante Turnstile de Cloudflare para formularios; desactivado.

Notas sobre licencias:
- `Elementor Pro` requiere licencia activa. Validar estado y transferencia en el nuevo ambiente.

---

## 9. Medios y uploads

- Estructura estándar en `wp-content/uploads/` por año/mes.
- No se utilizan servicios externos (S3, CDN) en este entregable.

---

## 10. Mantenimiento y actualización

- Mantener actualizado: Core, temas y plugins desde el panel.
- Recomendación: Backup completo (archivos + BD) antes de cualquier actualización.
- Cron: solo WP‑Cron estándar; no hay cron jobs personalizados.

---

## 11. Despliegue y migración

- No hay pipeline CI/CD; despliegue manual: copiar archivos y BD.
- Migración planeada a AWS (cliente). Este servidor es temporal para pruebas.
- DNS/CDN/Analytics: gestionados por el cliente.

---

## 12. Comandos útiles (WP‑CLI)

- Actualizar URLs del sitio:
  - `wp search-replace 'https://demo.ecoce.mx' 'https://tu-dominio.com' --all-tables --precise`
- Limpiar cachés transients:
  - `wp transient delete --all`
- Ver estado de plugins/tema:
  - `wp plugin list`
  - `wp theme list`

---

## 13. Seguridad recomendada

- Activar un plugin de seguridad (recomendamos Wordfence) en producción.
- Asegurar backups regulares y acceso SSH con claves.
- Mantener `WPS Hide Login` con una ruta no trivial.

---

## 14. Contacto y soporte

- El repositorio privado vive en GitLab bajo la cuenta indicada por el cliente.
- Proveer correos/usuarios para acceso al repositorio según corresponda.