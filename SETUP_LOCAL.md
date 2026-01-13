# Guía de Configuración Local - ECOCE WordPress

Esta guía te ayudará a configurar el proyecto WordPress de ECOCE en tu entorno local.

## Opción 1: Local by Flywheel (Recomendado - Más fácil)

### Requisitos
- Descargar e instalar [Local by Flywheel](https://localwp.com/) (gratis)

### Pasos

1. **Instalar Local by Flywheel**
   - Descarga desde https://localwp.com/
   - Instala la aplicación

2. **Crear un nuevo sitio**
   - Abre Local by Flywheel
   - Click en "Create a new site"
   - Nombre: `ecoce-wp` (o el que prefieras)
   - Selecciona "Preferred" como entorno
   - En "WordPress", selecciona:
     - WordPress version: `6.8.3`
     - PHP version: `8.4` (o la más cercana disponible)
   - Crea el sitio

3. **Reemplazar archivos del sitio**
   - Local creará una carpeta en tu sistema (normalmente en `~/Local Sites/ecoce-wp/app/public/`)
   - **Copia todos los archivos de este proyecto** a esa carpeta (reemplazando los archivos por defecto)
   - **NO reemplaces** el archivo `wp-config.php` que Local creó

4. **Configurar wp-config.php**
   - Abre el `wp-config.php` que Local creó
   - Verifica que las credenciales de base de datos coincidan con las que Local generó
   - Si necesitas ajustar algo, usa las credenciales que Local muestra en su panel

5. **Importar la base de datos**
   - En Local, haz click en tu sitio → "Database" → "Open Adminer" (o phpMyAdmin)
   - Selecciona la base de datos del sitio
   - Ve a "Import"
   - Selecciona el archivo `.sql` del proyecto (ej: `backup-2025-11-18_06-26-44.sql`)
   - Click en "Go" para importar

6. **Actualizar URLs**
   - En Local, abre "Open Site SSH"
   - Ejecuta (reemplaza `ecoce-wp.local` con la URL que Local asignó):
     ```bash
     wp search-replace 'https://demo.ecoce.mx' 'https://ecoce-wp.local' --all-tables --precise
     ```
   - O manualmente en Adminer/phpMyAdmin, ejecuta:
     ```sql
     UPDATE wp_options SET option_value = 'https://ecoce-wp.local' WHERE option_name = 'siteurl';
     UPDATE wp_options SET option_value = 'https://ecoce-wp.local' WHERE option_name = 'home';
     ```

7. **Acceder al sitio**
   - En Local, click en "Open Site" para ver el sitio
   - Para acceder al admin, usa la URL personalizada: `https://ecoce-wp.local/iniciar-sesion/`
   - Las credenciales de admin están en la base de datos importada

---

## Opción 2: MAMP / XAMPP (Tradicional)

### Requisitos
- [MAMP](https://www.mamp.info/) (Mac) o [XAMPP](https://www.apachefriends.org/) (Windows/Mac/Linux)
- PHP 8.4.x
- MySQL 8.0.x

### Pasos

1. **Instalar MAMP/XAMPP**
   - Instala MAMP o XAMPP
   - Asegúrate de que PHP 8.4 y MySQL 8.0 estén disponibles

2. **Configurar el proyecto**
   - Copia todos los archivos del proyecto a la carpeta `htdocs` (XAMPP) o `htdocs` (MAMP)
   - O crea un virtual host apuntando a la carpeta del proyecto

3. **Crear base de datos**
   - Abre phpMyAdmin (normalmente en `http://localhost/phpmyadmin`)
   - Crea una nueva base de datos (ej: `ecoce_wp`)

4. **Configurar wp-config.php**
   - Copia `wp-config-sample.php` a `wp-config.php`
   - Edita `wp-config.php` con:
     ```php
     define( 'DB_NAME', 'ecoce_wp' );
     define( 'DB_USER', 'root' );
     define( 'DB_PASSWORD', 'root' ); // o la contraseña que uses
     define( 'DB_HOST', 'localhost' );
     ```
   - Genera nuevas keys en: https://api.wordpress.org/secret-key/1.1/salt/

5. **Importar base de datos**
   - En phpMyAdmin, selecciona la base de datos creada
   - Ve a "Importar"
   - Selecciona el archivo `.sql` del proyecto
   - Click en "Continuar"

6. **Actualizar URLs**
   - En phpMyAdmin, ejecuta:
     ```sql
     UPDATE wp_options SET option_value = 'http://localhost/ecoce-wp' WHERE option_name = 'siteurl';
     UPDATE wp_options SET option_value = 'http://localhost/ecoce-wp' WHERE option_name = 'home';
     ```
   - O usa WP-CLI si lo tienes instalado

7. **Acceder al sitio**
   - Abre `http://localhost/ecoce-wp` en tu navegador
   - Para admin: `http://localhost/ecoce-wp/iniciar-sesion/`

---

## Opción 3: Docker (Para desarrolladores)

Si prefieres usar Docker, puedes crear un `docker-compose.yml`:

```yaml
version: '3.8'

services:
  wordpress:
    image: wordpress:6.8.3-php8.4
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DB_NAME: wordpress
    volumes:
      - .:/var/www/html
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress
      MYSQL_ROOT_PASSWORD: rootpassword
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

Luego:
```bash
docker-compose up -d
# Importar la base de datos
docker-compose exec db mysql -u wordpress -pwordpress wordpress < backup-2025-11-18_06-26-44.sql
# Actualizar URLs
docker-compose exec wordpress wp search-replace 'https://demo.ecoce.mx' 'http://localhost:8080' --all-tables --precise
```

---

## Notas Importantes

- **Credenciales de admin**: Las credenciales están en la base de datos importada. Si no las conoces, puedes resetear la contraseña desde phpMyAdmin o crear un nuevo usuario admin.

- **Permisos de archivos**: En Linux/Mac, asegúrate de que los permisos sean correctos:
  ```bash
  find . -type d -exec chmod 755 {} \;
  find . -type f -exec chmod 644 {} \;
  ```

- **Plugins Premium**: Elementor Pro requiere una licencia activa. Necesitarás una licencia válida para usar todas sus funcionalidades.

- **URLs personalizadas**: El sitio usa WPS Hide Login, por lo que la URL de login es `/iniciar-sesion/` en lugar de `/wp-login.php`.

---

## Solución de Problemas

**Error de conexión a base de datos:**
- Verifica las credenciales en `wp-config.php`
- Asegúrate de que MySQL esté corriendo
- Verifica que la base de datos exista

**Error 404 en páginas:**
- Verifica que los permalinks estén configurados (Settings → Permalinks en WordPress)
- Si usas Apache, asegúrate de que `mod_rewrite` esté activado

**Problemas con Elementor:**
- Asegúrate de tener una licencia válida de Elementor Pro
- Verifica que todos los plugins estén activos
