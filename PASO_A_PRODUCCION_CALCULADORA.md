# 🚀 Guía de Pase a Producción - Página Calculadora

Este documento describe el proceso paso a paso para migrar la página custom `/calculadora/` desde el entorno local de desarrollo al servidor de producción.

---

## ⚡ Resumen Rápido

### Archivos a Migrar
1. `template-calculadora.php` → Template principal
2. `assets/css/calculadora.css` → Estilos de la calculadora
3. `functions.php` → Actualizar con funciones de calculadora
4. `assets/images/*.svg` → Iconos de materiales (8 archivos)
5. `assets/images/*.png` → Imágenes de mascota y beneficios (9 archivos)

### Pasos Críticos
1. ✅ Transferir todos los archivos a producción
2. ✅ Actualizar `functions.php` con las funciones necesarias
3. ✅ Crear la página en WordPress con template asignado
4. ✅ Verificar que la tabla `wp_calculadora_ecoce` se crea automáticamente
5. ✅ Probar el formulario completo y verificar guardado de datos

### Comandos Rápidos
```bash
# Transferir archivos (ajustar rutas según tu servidor)
scp template-calculadora.php usuario@servidor:/var/www/ecoce/wp-content/themes/hello-elementor/
scp assets/css/calculadora.css usuario@servidor:/var/www/ecoce/wp-content/themes/hello-elementor/assets/css/
scp -r assets/images/* usuario@servidor:/var/www/ecoce/wp-content/themes/hello-elementor/assets/images/

# Crear página en producción
wp post create --post_type=page --post_title='Calculadora' --post_name='calculadora' --post_status=publish
wp post meta update [PAGE_ID] _wp_page_template template-calculadora.php

# Verificar tabla
wp db query "SHOW TABLES LIKE '%calculadora_ecoce%';"
```

---

## 📋 Información de la Funcionalidad

- **Ruta**: `/calculadora/`
- **Tipo**: Página custom con template personalizado
- **Template**: `template-calculadora.php`
- **Características**: 
  - Usa header y footer de Elementor
  - Contenido custom en el medio
  - Formulario multi-paso (5 pasos)
  - Cálculo automático de beneficios medioambientales
  - Guardado automático de datos en base de datos
  - Botón de acceso desde `/recursos/`

---

## 📋 Tabla de Contenidos

1. [Verificación Pre-Migración](#verificación-pre-migración)
2. [Archivos a Migrar](#archivos-a-migrar)
3. [Migración de la Página](#migración-de-la-página)
4. [Migración del Template](#migración-del-template)
5. [Actualización de URLs](#actualización-de-urls)
6. [Verificación Post-Migración](#verificación-post-migración)
7. [Checklist Final](#checklist-final)

---

## 1. Verificación Pre-Migración

### 1.1 Verificar en Local

Antes de migrar, verifica que todo funciona correctamente en local:

```bash
# Navegar al directorio del proyecto
cd /Users/rodolforamirezaguilera/Work/ecoce_wp/ecoce-wp

# Verificar que el template existe
ls -la wp-content/themes/hello-elementor/template-calculadora.php

# Verificar que la página existe en la base de datos
mysql -u rodolforamirezaguilera ecoce_wp -e "SELECT ID, post_name, post_title, post_status FROM wp_posts WHERE post_name = 'calculadora';"
```

### 1.2 Verificar Funcionalidad

- [ ] Acceder a `http://localhost:8000/calculadora/`
- [ ] Verificar que el header de Elementor se muestra
- [ ] Verificar que el footer de Elementor se muestra
- [ ] Verificar que el contenido custom se muestra
- [ ] Verificar que el botón en `/recursos/` redirige correctamente

---

## 2. Archivos a Migrar

### 2.1 Archivos Necesarios

Los siguientes archivos deben migrarse a producción:

```
wp-content/themes/hello-elementor/template-calculadora.php
wp-content/themes/hello-elementor/assets/css/calculadora.css
wp-content/themes/hello-elementor/functions.php (actualizar con nuevas funciones)
```

### 2.2 Imágenes y Assets

Las siguientes imágenes deben estar presentes en producción:

```
wp-content/themes/hello-elementor/assets/images/mascota.png
wp-content/themes/hello-elementor/assets/images/mascota_2.png
wp-content/themes/hello-elementor/assets/images/basura.png
wp-content/themes/hello-elementor/assets/images/pet.svg
wp-content/themes/hello-elementor/assets/images/pead.svg
wp-content/themes/hello-elementor/assets/images/pebd.svg
wp-content/themes/hello-elementor/assets/images/bopp.svg
wp-content/themes/hello-elementor/assets/images/carton.svg
wp-content/themes/hello-elementor/assets/images/vidrio.svg
wp-content/themes/hello-elementor/assets/images/aluminio.svg
wp-content/themes/hello-elementor/assets/images/hojalata.svg
wp-content/themes/hello-elementor/assets/images/refrigerador.png
wp-content/themes/hello-elementor/assets/images/arboles.png
wp-content/themes/hello-elementor/assets/images/camiones.png
wp-content/themes/hello-elementor/assets/images/agua.png
wp-content/themes/hello-elementor/assets/images/combustible.png
wp-content/themes/hello-elementor/assets/images/ciudad.png
```

### 2.3 Información de Base de Datos

La página se crea en la base de datos con:
- **Post Type**: `page`
- **Post Name (slug)**: `calculadora`
- **Post Title**: `Calculadora`
- **Template**: `template-calculadora.php`

**Tabla personalizada para datos de la calculadora:**
- **Nombre de la tabla**: `wp_calculadora_ecoce` (se crea automáticamente)
- **Campos**: id, uuid, nombre, pet, pead, poli, pp, carton_multilaminado, vidrio, latas_aluminio, latas_hojalata, total, refrigerador, arboles_cortados, camiones_basura, dias_agua, km_en_auto, kg_de_co2, created_at

---

## 3. Migración de la Página

### 3.1 Opción A: Migración Manual (Recomendado)

#### Paso 1: Crear la página en producción

```bash
# Conectar al servidor de producción
ssh usuario@servidor-produccion.com

# Acceder al directorio del sitio
cd /var/www/ecoce

# Crear la página usando WP-CLI
wp post create --post_type=page --post_title='Calculadora' --post_name='calculadora' --post_status=publish
```

**Nota**: Guarda el ID de la página que se muestra después de crear.

#### Paso 2: Asignar el template

```bash
# Reemplazar [PAGE_ID] con el ID obtenido en el paso anterior
wp post meta update [PAGE_ID] _wp_page_template template-calculadora.php

# Verificar que se asignó correctamente
wp post meta get [PAGE_ID] _wp_page_template
```

### 3.2 Opción B: Migración desde Base de Datos

#### Paso 1: Exportar la página desde local

```bash
# Desde tu máquina local
mysql -u rodolforamirezaguilera ecoce_wp -e "SELECT * FROM wp_posts WHERE post_name = 'calculadora' AND post_type = 'page';" > calculadora_page.sql

# Exportar también los metadatos
mysql -u rodolforamirezaguilera ecoce_wp -e "SELECT * FROM wp_postmeta WHERE post_id = (SELECT ID FROM wp_posts WHERE post_name = 'calculadora' AND post_type = 'page' LIMIT 1);" >> calculadora_meta.sql
```

#### Paso 2: Importar en producción

```bash
# En el servidor de producción
cd /var/www/ecoce

# Importar la página (ajustar ID si es necesario)
mysql -u ecoce_user -p ecoce_prod < calculadora_page.sql

# Importar metadatos
mysql -u ecoce_user -p ecoce_prod < calculadora_meta.sql

# Verificar que se creó correctamente
wp post list --post_type=page --name=calculadora
```

---

## 4. Migración del Template y Archivos Relacionados

### 4.1 Transferir el Template

#### Opción A: Usando SCP

```bash
# Desde tu máquina local
scp wp-content/themes/hello-elementor/template-calculadora.php \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/

# Transferir CSS
scp wp-content/themes/hello-elementor/assets/css/calculadora.css \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/assets/css/

# Transferir imágenes (usar -r para recursivo si hay muchas)
scp -r wp-content/themes/hello-elementor/assets/images/*.svg \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/assets/images/

scp wp-content/themes/hello-elementor/assets/images/mascota*.png \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/assets/images/

scp wp-content/themes/hello-elementor/assets/images/basura.png \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/assets/images/

scp wp-content/themes/hello-elementor/assets/images/*.png \
  usuario@servidor-produccion.com:/var/www/ecoce/wp-content/themes/hello-elementor/assets/images/
```

#### Opción B: Usando Git

```bash
# Si los archivos están en el repositorio Git
# En el servidor de producción
cd /var/www/ecoce
git pull origin main
```

#### Opción C: Crear manualmente

```bash
# En el servidor de producción
cd /var/www/ecoce/wp-content/themes/hello-elementor

# Crear directorios si no existen
mkdir -p assets/css
mkdir -p assets/images

# Crear archivos
nano template-calculadora.php
nano assets/css/calculadora.css
```

Copiar el contenido de los archivos locales.

### 4.2 Actualizar functions.php

**IMPORTANTE**: El archivo `functions.php` debe contener las funciones para la calculadora:

```bash
# En el servidor de producción
cd /var/www/ecoce/wp-content/themes/hello-elementor

# Verificar que functions.php contiene las funciones necesarias
grep -n "hello_elementor_enqueue_calculadora_styles" functions.php
grep -n "hello_elementor_create_calculadora_table" functions.php
grep -n "hello_elementor_save_calculadora_data" functions.php
```

Si no están presentes, agregar al final de `functions.php` (antes de `require HELLO_THEME_PATH . '/theme.php';`):

```php
/**
 * Enqueue CSS para la página Calculadora
 */
if ( ! function_exists( 'hello_elementor_enqueue_calculadora_styles' ) ) {
	function hello_elementor_enqueue_calculadora_styles() {
		if ( is_page_template( 'template-calculadora.php' ) ) {
			wp_enqueue_style(
				'hello-elementor-calculadora',
				HELLO_THEME_STYLE_URL . 'calculadora.css',
				array(),
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_enqueue_calculadora_styles' );

/**
 * Crear tabla para guardar datos de la calculadora
 */
if ( ! function_exists( 'hello_elementor_create_calculadora_table' ) ) {
	function hello_elementor_create_calculadora_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'calculadora_ecoce';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			uuid varchar(36) NOT NULL,
			nombre varchar(255) NOT NULL,
			pet decimal(10,2) DEFAULT 0,
			pead decimal(10,2) DEFAULT 0,
			poli decimal(10,2) DEFAULT 0,
			pp decimal(10,2) DEFAULT 0,
			carton_multilaminado decimal(10,2) DEFAULT 0,
			vidrio decimal(10,2) DEFAULT 0,
			latas_aluminio decimal(10,2) DEFAULT 0,
			latas_hojalata decimal(10,2) DEFAULT 0,
			total decimal(10,2) DEFAULT 0,
			refrigerador decimal(10,2) DEFAULT 0,
			arboles_cortados decimal(10,2) DEFAULT 0,
			camiones_basura decimal(10,2) DEFAULT 0,
			dias_agua decimal(10,2) DEFAULT 0,
			km_en_auto decimal(10,2) DEFAULT 0,
			kg_de_co2 decimal(10,2) DEFAULT 0,
			created_at datetime DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY  (id),
			KEY uuid (uuid),
			KEY created_at (created_at)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_create_calculadora_table' );

/**
 * Endpoint AJAX para guardar datos de la calculadora
 */
if ( ! function_exists( 'hello_elementor_save_calculadora_data' ) ) {
	function hello_elementor_save_calculadora_data() {
		check_ajax_referer( 'calculadora_nonce', 'nonce' );

		global $wpdb;
		$table_name = $wpdb->prefix . 'calculadora_ecoce';

		// Generar UUID
		if ( function_exists( 'wp_generate_uuid4' ) ) {
			$uuid = wp_generate_uuid4();
		} else {
			$uuid = sprintf(
				'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
				mt_rand( 0, 0xffff ),
				mt_rand( 0, 0x0fff ) | 0x4000,
				mt_rand( 0, 0x3fff ) | 0x8000,
				mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
			);
		}

		$data = array(
			'uuid' => $uuid,
			'nombre' => sanitize_text_field( $_POST['nombre'] ?? '' ),
			'pet' => floatval( $_POST['pet'] ?? 0 ),
			'pead' => floatval( $_POST['pead'] ?? 0 ),
			'poli' => floatval( $_POST['poli'] ?? 0 ),
			'pp' => floatval( $_POST['pp'] ?? 0 ),
			'carton_multilaminado' => floatval( $_POST['carton_multilaminado'] ?? 0 ),
			'vidrio' => floatval( $_POST['vidrio'] ?? 0 ),
			'latas_aluminio' => floatval( $_POST['latas_aluminio'] ?? 0 ),
			'latas_hojalata' => floatval( $_POST['latas_hojalata'] ?? 0 ),
			'total' => floatval( $_POST['total'] ?? 0 ),
			'refrigerador' => floatval( $_POST['refrigerador'] ?? 0 ),
			'arboles_cortados' => floatval( $_POST['arboles_cortados'] ?? 0 ),
			'camiones_basura' => floatval( $_POST['camiones_basura'] ?? 0 ),
			'dias_agua' => floatval( $_POST['dias_agua'] ?? 0 ),
			'km_en_auto' => floatval( $_POST['km_en_auto'] ?? 0 ),
			'kg_de_co2' => floatval( $_POST['kg_de_co2'] ?? 0 ),
		);

		$result = $wpdb->insert( $table_name, $data );

		if ( $result !== false ) {
			wp_send_json_success( array(
				'message' => 'Datos guardados correctamente',
				'uuid' => $uuid,
				'id' => $wpdb->insert_id
			) );
		} else {
			wp_send_json_error( array(
				'message' => 'Error al guardar los datos: ' . $wpdb->last_error
			) );
		}
	}
}
add_action( 'wp_ajax_save_calculadora_data', 'hello_elementor_save_calculadora_data' );
add_action( 'wp_ajax_nopriv_save_calculadora_data', 'hello_elementor_save_calculadora_data' );

/**
 * Localizar script para AJAX
 */
if ( ! function_exists( 'hello_elementor_localize_calculadora_script' ) ) {
	function hello_elementor_localize_calculadora_script() {
		if ( is_page_template( 'template-calculadora.php' ) ) {
			wp_localize_script( 'jquery', 'calculadoraAjax', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'calculadora_nonce' )
			) );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_localize_calculadora_script' );
```

### 4.3 Verificar Permisos

```bash
# En el servidor de producción
cd /var/www/ecoce/wp-content/themes/hello-elementor

# Verificar que los archivos existen
ls -la template-calculadora.php
ls -la assets/css/calculadora.css
ls -la assets/images/*.svg
ls -la assets/images/*.png

# Ajustar permisos si es necesario
sudo chown www-data:www-data template-calculadora.php
sudo chown -R www-data:www-data assets/
chmod 644 template-calculadora.php
chmod 644 assets/css/calculadora.css
chmod 644 assets/images/*
```

### 4.4 Verificar Creación de Tabla en Base de Datos

La tabla se crea automáticamente cuando WordPress carga, pero puedes verificar manualmente:

```bash
# En el servidor de producción
cd /var/www/ecoce

# Verificar que la tabla existe
wp db query "SHOW TABLES LIKE '%calculadora_ecoce%';"

# Ver estructura de la tabla
wp db query "DESCRIBE wp_calculadora_ecoce;"

# Si la tabla no existe, forzar su creación accediendo a la página
# O ejecutar manualmente:
wp eval 'hello_elementor_create_calculadora_table();'
```

### 4.5 Contenido del Template

El template debe contener:

```php
<?php
/**
 * Template Name: Calculadora Custom
 * 
 * Template custom para la página de calculadora que usa header y footer de Elementor
 * pero permite contenido custom en el medio
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Añadir clase de body para Elementor
if ( class_exists( '\Elementor\Plugin' ) ) {
	\Elementor\Plugin::$instance->frontend->add_body_class( 'elementor-template-full-width' );
}

get_header();
?>

<main id="content" class="site-main calculadora-custom-content">
	
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		
		<div class="calculadora-container">
			<?php
			// Aquí va el contenido custom de la calculadora
			// Por ahora mostramos el contenido de la página
			the_content();
			?>
			
			<!-- Contenedor para la calculadora custom -->
			<div id="calculadora-ecologica" class="calculadora-wrapper">
				<!-- El contenido de la calculadora se cargará aquí -->
				<div class="calculadora-placeholder">
					<h1>Calculadora Ecológica</h1>
					<p>Contenido custom de la calculadora aquí</p>
				</div>
			</div>
			
		</div>
		
		<?php
	endwhile;
	?>
	
</main>

<style>
.calculadora-custom-content {
	padding: 40px 0;
	min-height: 60vh;
}

.calculadora-container {
	max-width: 1200px;
	margin: 0 auto;
	padding: 0 20px;
}

.calculadora-wrapper {
	background: #fff;
	border-radius: 16px;
	padding: 40px;
	margin-top: 30px;
	box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.calculadora-placeholder {
	text-align: center;
	padding: 60px 20px;
}

.calculadora-placeholder h1 {
	color: #0A3B1B;
	margin-bottom: 20px;
}

.calculadora-placeholder p {
	color: #666;
	font-size: 18px;
}
</style>

<?php
get_footer();
```

---

## 5. Actualización de URLs

### 5.1 Verificar URL del Botón

El botón "Utilizar calculadora" en la página `/recursos/` debe apuntar a `/calculadora/`.

#### Verificar en producción:

```bash
# En el servidor de producción
cd /var/www/ecoce

# Buscar la página de recursos
wp post list --post_type=page --name=recursos

# Verificar que el botón apunta correctamente (buscar en Elementor data)
wp post meta get [RECURSOS_PAGE_ID] _elementor_data | grep -o '"url":"[^"]*calculadora[^"]*"'
```

#### Si necesita actualización:

```bash
# Actualizar URL del botón si es necesario
wp search-replace 'http://localhost:8000/calculadora' 'https://www.ecoce.mx/calculadora' --all-tables --precise

# O si viene de demo.ecoce.mx
wp search-replace 'https://demo.ecoce.mx/calculadora' 'https://www.ecoce.mx/calculadora' --all-tables --precise
```

### 5.2 Actualizar URLs en Elementor

Si el botón está configurado en Elementor, también puedes actualizarlo desde el panel:

1. Acceder a `https://www.ecoce.mx/iniciar-sesion/`
2. Ir a Páginas → Recursos → Editar con Elementor
3. Buscar el botón "Utilizar calculadora"
4. Verificar que la URL sea `/calculadora/` o `https://www.ecoce.mx/calculadora/`
5. Guardar cambios

---

## 6. Verificación Post-Migración

### 6.1 Verificar Acceso a la Página

- [ ] Acceder a `https://www.ecoce.mx/calculadora/`
- [ ] Verificar que la página carga sin errores
- [ ] Verificar que el header de Elementor se muestra correctamente
- [ ] Verificar que el footer de Elementor se muestra correctamente
- [ ] Verificar que el contenido custom se muestra

### 6.2 Verificar Funcionalidad del Botón

- [ ] Acceder a `https://www.ecoce.mx/recursos/`
- [ ] Localizar el botón "Utilizar calculadora"
- [ ] Hacer clic en el botón
- [ ] Verificar que redirige a `/calculadora/`
- [ ] Verificar que la página de calculadora carga correctamente

### 6.3 Verificar en Diferentes Dispositivos

- [ ] Verificar en escritorio (1920x1080)
- [ ] Verificar en tablet (768px)
- [ ] Verificar en móvil (375px)
- [ ] Verificar que el diseño es responsive

### 6.4 Verificar Logs

```bash
# En el servidor de producción
# Verificar logs de errores de PHP
sudo tail -f /var/log/php8.4-fpm.log | grep -i calculadora

# Verificar logs de Nginx
sudo tail -f /var/log/nginx/ecoce_error.log | grep -i calculadora

# Verificar logs de WordPress (si WP_DEBUG_LOG está activo)
tail -f /var/www/ecoce/wp-content/debug.log | grep -i calculadora
```

### 6.5 Verificar Base de Datos

```bash
# En el servidor de producción
cd /var/www/ecoce

# Verificar que la página existe
wp post list --post_type=page --name=calculadora

# Verificar que el template está asignado
wp post meta get [PAGE_ID] _wp_page_template

# Verificar el permalink
wp post get [PAGE_ID] --field=url

# Verificar que la tabla de calculadora existe
wp db query "SHOW TABLES LIKE '%calculadora_ecoce%';"

# Verificar estructura de la tabla
wp db query "DESCRIBE wp_calculadora_ecoce;"

# Verificar que hay registros (después de probar la calculadora)
wp db query "SELECT COUNT(*) as total FROM wp_calculadora_ecoce;"
```

### 6.6 Verificar Funcionalidad AJAX

```bash
# En el servidor de producción
# Abrir la consola del navegador (F12) al acceder a /calculadora/
# Completar el formulario hasta el paso 5
# Verificar en la consola que aparece: "Datos guardados correctamente"

# O verificar directamente en la base de datos después de usar la calculadora
wp db query "SELECT * FROM wp_calculadora_ecoce ORDER BY created_at DESC LIMIT 1;"
```

### 6.7 Verificar Archivos CSS e Imágenes

```bash
# En el servidor de producción
cd /var/www/ecoce/wp-content/themes/hello-elementor

# Verificar que el CSS se carga correctamente
curl -I https://www.ecoce.mx/wp-content/themes/hello-elementor/assets/css/calculadora.css

# Verificar que las imágenes existen y son accesibles
curl -I https://www.ecoce.mx/wp-content/themes/hello-elementor/assets/images/mascota.png
curl -I https://www.ecoce.mx/wp-content/themes/hello-elementor/assets/images/pet.svg

# Verificar en el navegador que las imágenes se cargan
# Abrir: https://www.ecoce.mx/calculadora/
# Inspeccionar elementos y verificar que las imágenes tienen rutas correctas
```

---

## 7. Checklist Final

### Archivos Migrados

- [ ] `template-calculadora.php` transferido a producción
- [ ] `assets/css/calculadora.css` transferido a producción
- [ ] `functions.php` actualizado con funciones de calculadora
- [ ] Todas las imágenes SVG transferidas (pet.svg, pead.svg, pebd.svg, bopp.svg, carton.svg, vidrio.svg, aluminio.svg, hojalata.svg)
- [ ] Todas las imágenes PNG transferidas (mascota.png, mascota_2.png, basura.png, refrigerador.png, arboles.png, camiones.png, agua.png, combustible.png, ciudad.png)
- [ ] Permisos de archivos configurados correctamente (644)
- [ ] Propietario de archivos configurado (www-data:www-data)

### Base de Datos

- [ ] Página "Calculadora" creada en producción
- [ ] Slug de la página es `calculadora`
- [ ] Template asignado: `template-calculadora.php`
- [ ] Estado de la página: `publish`
- [ ] Tabla `wp_calculadora_ecoce` creada automáticamente
- [ ] Estructura de la tabla verificada (todos los campos presentes)
- [ ] Endpoints AJAX funcionando (`save_calculadora_data`)

### Funcionalidad

- [ ] Página accesible en `https://www.ecoce.mx/calculadora/`
- [ ] Header de Elementor se muestra correctamente
- [ ] Footer de Elementor se muestra correctamente
- [ ] Contenido custom se muestra correctamente
- [ ] CSS de calculadora se carga correctamente
- [ ] Todas las imágenes se muestran correctamente
- [ ] Formulario multi-paso funciona (pasos 1-5)
- [ ] Cálculos de beneficios medioambientales funcionan
- [ ] Datos se guardan en la base de datos al completar paso 5
- [ ] Botón "Empezar de nuevo" funciona correctamente
- [ ] Botón en `/recursos/` funciona correctamente
- [ ] Redirección funciona sin errores

### URLs

- [ ] URLs actualizadas de localhost a dominio de producción
- [ ] URLs actualizadas de demo.ecoce.mx a dominio de producción
- [ ] Botón apunta a la URL correcta

### Testing

- [ ] Probado en escritorio
- [ ] Probado en tablet
- [ ] Probado en móvil
- [ ] Formulario completo probado (todos los pasos)
- [ ] Guardado de datos verificado en base de datos
- [ ] Sin errores en consola del navegador
- [ ] Sin errores en logs del servidor
- [ ] AJAX funciona correctamente (verificar Network tab)
- [ ] Imágenes cargan correctamente
- [ ] CSS se aplica correctamente

---

## 🔧 Solución de Problemas

### Error: "Template not found"

**Problema**: WordPress no encuentra el template.

**Solución**:
```bash
# Verificar que el archivo existe
ls -la /var/www/ecoce/wp-content/themes/hello-elementor/template-calculadora.php

# Verificar permisos
chmod 644 template-calculadora.php
chown www-data:www-data template-calculadora.php

# Verificar que el template está asignado correctamente
wp post meta get [PAGE_ID] _wp_page_template
```

### Error: "404 Not Found"

**Problema**: La página no se encuentra.

**Solución**:
```bash
# Regenerar permalinks
wp rewrite flush

# Verificar que el slug es correcto
wp post list --post_type=page --name=calculadora

# Verificar permalink
wp post get [PAGE_ID] --field=url
```

### Error: Header/Footer no se muestran

**Problema**: El header o footer de Elementor no aparecen.

**Solución**:
```bash
# Verificar que Elementor está activo
wp plugin list | grep elementor

# Verificar que los templates de header/footer existen en Elementor
# Acceder al panel: Plantillas → Theme Builder
```

### Error: Botón no redirige correctamente

**Problema**: El botón en `/recursos/` no funciona.

**Solución**:
```bash
# Buscar y actualizar URLs en Elementor data
wp search-replace 'http://localhost:8000/calculadora' 'https://www.ecoce.mx/calculadora' --all-tables --precise

# O actualizar manualmente desde Elementor
# Editar la página Recursos → Buscar el botón → Actualizar URL
```

### Error: Tabla no se crea automáticamente

**Problema**: La tabla `wp_calculadora_ecoce` no existe.

**Solución**:
```bash
# En el servidor de producción
cd /var/www/ecoce

# Forzar creación de la tabla ejecutando la función
wp eval 'hello_elementor_create_calculadora_table();'

# O crear manualmente
wp db query "CREATE TABLE IF NOT EXISTS wp_calculadora_ecoce (
    id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    uuid varchar(36) NOT NULL,
    nombre varchar(255) NOT NULL,
    pet decimal(10,2) DEFAULT 0,
    pead decimal(10,2) DEFAULT 0,
    poli decimal(10,2) DEFAULT 0,
    pp decimal(10,2) DEFAULT 0,
    carton_multilaminado decimal(10,2) DEFAULT 0,
    vidrio decimal(10,2) DEFAULT 0,
    latas_aluminio decimal(10,2) DEFAULT 0,
    latas_hojalata decimal(10,2) DEFAULT 0,
    total decimal(10,2) DEFAULT 0,
    refrigerador decimal(10,2) DEFAULT 0,
    arboles_cortados decimal(10,2) DEFAULT 0,
    camiones_basura decimal(10,2) DEFAULT 0,
    dias_agua decimal(10,2) DEFAULT 0,
    km_en_auto decimal(10,2) DEFAULT 0,
    kg_de_co2 decimal(10,2) DEFAULT 0,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (id),
    KEY uuid (uuid),
    KEY created_at (created_at)
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
```

### Error: AJAX no funciona / Datos no se guardan

**Problema**: Los datos no se guardan al completar el paso 5.

**Solución**:
```bash
# Verificar que el endpoint AJAX está registrado
wp eval 'var_dump(has_action("wp_ajax_save_calculadora_data"));'

# Verificar logs de PHP para errores AJAX
sudo tail -f /var/log/php8.4-fpm.log | grep -i ajax

# Verificar en consola del navegador (F12 → Network tab)
# Buscar la petición a admin-ajax.php y verificar respuesta

# Verificar que jQuery está cargado
# En el navegador: console.log(typeof jQuery)
```

### Error: CSS no se carga

**Problema**: Los estilos de la calculadora no se aplican.

**Solución**:
```bash
# Verificar que el archivo existe
ls -la /var/www/ecoce/wp-content/themes/hello-elementor/assets/css/calculadora.css

# Verificar permisos
chmod 644 assets/css/calculadora.css

# Verificar que la función de enqueue está en functions.php
grep -n "hello_elementor_enqueue_calculadora_styles" functions.php

# Verificar en el navegador (F12 → Network tab)
# Buscar calculadora.css y verificar que carga con código 200
```

### Error: Imágenes no se muestran

**Problema**: Las imágenes SVG o PNG no aparecen.

**Solución**:
```bash
# Verificar que las imágenes existen
ls -la /var/www/ecoce/wp-content/themes/hello-elementor/assets/images/

# Verificar permisos
chmod 644 assets/images/*

# Verificar rutas en el template
grep -n "assets/images" template-calculadora.php

# Verificar en el navegador (F12 → Network tab)
# Buscar las imágenes y verificar que cargan con código 200
```

---

## 📝 Notas Adicionales

### Estructura del Template

El template `template-calculadora.php` está diseñado para:
- Usar el header y footer existentes de Elementor
- Permitir contenido completamente custom en el medio
- Mantener la estructura visual del sitio

### Personalización Futura

Para agregar funcionalidad a la calculadora:
1. Editar `template-calculadora.php` para cambios en HTML/JS
2. Editar `assets/css/calculadora.css` para cambios en estilos
3. Los scripts pueden agregarse usando `wp_enqueue_script()` en `functions.php` del tema
4. Los datos se guardan automáticamente en `wp_calculadora_ecoce` al completar el paso 5

### Consultar Datos Guardados

Para ver los datos guardados de la calculadora:

```bash
# Ver todos los registros
wp db query "SELECT * FROM wp_calculadora_ecoce ORDER BY created_at DESC;"

# Ver últimos 10 registros
wp db query "SELECT id, nombre, total, kg_de_co2, created_at FROM wp_calculadora_ecoce ORDER BY created_at DESC LIMIT 10;"

# Contar total de registros
wp db query "SELECT COUNT(*) as total FROM wp_calculadora_ecoce;"

# Estadísticas por material
wp db query "SELECT SUM(pet) as total_pet, SUM(pead) as total_pead, SUM(pp) as total_pp FROM wp_calculadora_ecoce;"
```

### Mantenimiento

- El template es independiente y no afecta otras páginas
- Los cambios al template solo afectan la página `/calculadora/`
- El header y footer se mantienen sincronizados con el resto del sitio

---

## ✅ Firma de Aceptación

- [ ] Migración completada: _________________ (Fecha)
- [ ] Verificado por: _________________ (Nombre)
- [ ] Aprobado por: _________________ (Nombre)

---

**Última actualización**: 2026-01-06
**Versión del documento**: 2.0
**Funcionalidad**: Página Calculadora Custom con Base de Datos y AJAX

---

## 📚 Recursos Adicionales

### Estructura de la Tabla `wp_calculadora_ecoce`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint(20) | ID único del registro |
| uuid | varchar(36) | UUID único del registro |
| nombre | varchar(255) | Nombre del usuario |
| pet, pead, poli, pp | decimal(10,2) | Materiales plásticos (kg) |
| carton_multilaminado, vidrio | decimal(10,2) | Materiales (kg) |
| latas_aluminio, latas_hojalata | decimal(10,2) | Materiales metálicos (kg) |
| total | decimal(10,2) | Total de materiales (kg) |
| refrigerador | decimal(10,2) | Días equivalentes de energía |
| arboles_cortados | decimal(10,2) | Árboles salvados |
| camiones_basura | decimal(10,2) | Camiones de basura evitados |
| dias_agua | decimal(10,2) | Días de agua ahorrados |
| km_en_auto | decimal(10,2) | Kilómetros equivalentes |
| kg_de_co2 | decimal(10,2) | Kilogramos de CO2 evitados |
| created_at | datetime | Fecha de creación |

### Endpoints AJAX

- **Acción**: `save_calculadora_data`
- **Método**: POST
- **Nonce**: Requerido (`calculadora_nonce`)
- **Respuesta**: JSON con `success` y `data` (uuid, id, message)

### Variables JavaScript Disponibles

- `calculadoraAjax.ajax_url` → URL del endpoint AJAX
- `calculadoraAjax.nonce` → Nonce para seguridad
