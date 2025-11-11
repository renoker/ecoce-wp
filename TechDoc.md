# Documento de Requerimientos para Transferencia de Proyecto WordPress

## Proyecto: ECOCE Rediseño

---

## 1. Información general del proyecto (Básico)

**Nombre del proyecto o sitio web:**  
ECOCE Rediseño

**URL pública y (si aplica) entorno de staging o pruebas:**  
R. demo.ecoce.mx (subdominio de pruebas del cliente). No se cuenta con entorno de staging adicional.

**Breve descripción del propósito del sitio:**  
R. Sitio web corporativo para ECOCE, enfocado en presentación institucional y comunicación de información.

**Persona de contacto técnico del equipo anterior (nombre, correo, teléfono):**  
R. No aplica. KJ es el equipo de desarrollo original del proyecto actual.

**Fecha estimada de entrega o transferencia:**  
R. Por definir con el cliente.

---

## 2. Accesos esenciales (Básico)

**Acceso al panel de administración WordPress: URL del panel (/wp-admin), usuario y contraseña de administrador.**  
R. URL de acceso: https://demo.ecoce.mx/iniciar-sesion/ (personalizada mediante plugin WPS Hide Login). Credenciales de administrador serán proporcionadas al momento de la transferencia de forma segura.

**Acceso al hosting o servidor: credenciales de cPanel / Plesk / panel de control equivalente, acceso SSH / FTP (usuario, host, puerto).**  
R. No se cuenta con cPanel, Plesk ni acceso FTP. El servidor se gestiona únicamente mediante SSH. Las credenciales SSH (host, usuario, puerto) serán proporcionadas al momento de la transferencia. Nota importante: El cliente realizará migración a AWS, por lo que este servidor es temporal para pruebas.

**Acceso a la base de datos: phpMyAdmin o conexión directa (host, usuario, contraseña, nombre de base de datos).**  
R. No se cuenta con phpMyAdmin. El acceso a la base de datos es únicamente mediante localhost a través de MySQL CLI. Se entregará dump completo de la base de datos en el repositorio para su importación en el nuevo ambiente.

**Acceso a dominio: proveedor de dominio (ej. GoDaddy, Namecheap), credenciales de acceso o contacto autorizado.**  
R. El dominio/subdominio demo.ecoce.mx es gestionado directamente por el cliente ECOCE. KJ no cuenta con acceso a la gestión de DNS.

**Acceso a correos corporativos (si el sitio los gestiona).**  
R. No aplica. El sitio WordPress no gestiona correos corporativos.

**Acceso a herramientas externas (Cloudflare, CDN, Google Analytics, Tag Manager, etc.).**  
R. Las herramientas externas son gestionadas directamente por el cliente ECOCE. KJ no cuenta con acceso a estas plataformas. Se recomienda que el cliente proporcione accesos si requiere que el nuevo equipo continúe con la gestión de estas herramientas.

---

## 3. Archivos y recursos del sitio (Intermedio)

**Copia completa del sitio (archivos y base de datos).**  
R. Se entregará en repositorio Git incluyendo todos los archivos de WordPress y dump completo de la base de datos. Tamaño total aproximado: 275 MB (archivos: 224 MB, base de datos: 50.55 MB).

**Información del tema activo: nombre del tema (y si es personalizado o hijo), carpeta del tema (zipped si es custom), documentación del tema.**  
R. Tema activo: Hello Elementor versión 3.4.5 (tema oficial de Elementor, no personalizado ni child theme). No requiere documentación adicional ya que es un tema estándar disponible en el repositorio oficial de WordPress.

**Plugins instalados: lista de plugins activos e inactivos con versiones, indicar cuáles son premium o de licencia, proveer claves o cuentas de licencia si es posible.**  
R. Plugins activos:
- Elementor versión 3.33.0 (gratuito)
- Elementor Pro versión 3.33.0 (PREMIUM - requiere licencia)
- MapSVG Lite versión 8.7.19 (gratuito)
- WPS Hide Login versión 1.9.17.2 (gratuito)
- Coming Soon and Maintenance by Colorlib versión 1.1.2 (gratuito)

Plugins inactivos:
- Simple CAPTCHA Alternative with Cloudflare Turnstile versión 1.35.0 (gratuito)

Nota sobre licencias: Elementor Pro requiere licencia activa. Se debe verificar con el cliente el estado y transferencia de la licencia para el nuevo ambiente.

**Recursos multimedia: estructura de carpetas /wp-content/uploads/, incluir endpoints o configuraciones si usan servicios externos.**  
R. Estructura estándar de WordPress en /wp-content/uploads/ organizada por año/mes. Tamaño total: 26.82 MB. No se utilizan servicios externos para almacenamiento de medios (no hay integración con S3, CDN u otros).

---

## 4. Configuración técnica y entornos (Avanzado)

**Versión actual de WordPress, PHP y base de datos.**  
R. WordPress 6.8.3, PHP 8.4.7, MySQL 8.0.43-0ubuntu0.22.04.1

**Información del servidor: sistema operativo, stack (Apache/Nginx), memoria, etc.**  
R. Sistema operativo: Linux 5.15.0-140-generic x86_64, Servidor web: Nginx 1.18.0, Recursos: 2 vCPU, 4 GB RAM, 120 GB SSD. Configuración PHP: memory_limit 128M, upload_max_filesize 64M, post_max_size 64M, max_execution_time 30s. Nota: Este es un servidor de pruebas temporal, el cliente migrará a AWS.

**Cron jobs configurados (si los hay).**  
R. No hay cron jobs personalizados configurados. Se utiliza únicamente el WP-Cron estándar de WordPress.

**Variables de entorno y archivos .env (si los hay).**  
R. No aplica. No se utilizan variables de entorno ni archivos .env. La configuración se encuentra en wp-config.php estándar.

**Configuración del .htaccess o equivalentes.**  
R. Al utilizar Nginx, no hay archivo .htaccess. La configuración de Nginx será incluida en el repositorio para referencia en el nuevo ambiente.

**Detalles de CDN, caching y seguridad (ej. WAF, plugins de seguridad, firewall).**  
R. No se utiliza CDN externo. No hay sistema de caché avanzado configurado. Seguridad: Se recomienda instalación de plugin de seguridad (WordFence o similar) en el ambiente de producción final.

**Backups automáticos: sistema usado (Updraft, JetBackup, etc.), frecuencia y ubicación de copias.**  
R. Los backups automáticos son responsabilidad y están gestionados por el cliente ECOCE en su infraestructura. No hay sistema de backup configurado por KJ en el servidor de pruebas.

---

## 5. Integraciones y dependencias (Avanzado)

**APIs o integraciones externas (por ejemplo, CRMs, ERPs, etc.).**  
R. No hay integraciones con APIs externas, CRMs o ERPs.

**Credenciales o tokens de API (de forma segura).**  
R. No aplica.

**Webhooks configurados.**  
R. No hay webhooks configurados.

**Scripts personalizados o código fuera del núcleo WordPress (por ejemplo, cron jobs externos o funciones PHP adicionales).**  
R. No hay scripts personalizados ni código custom fuera del núcleo de WordPress. Todo el desarrollo se basa en funcionalidades estándar de WordPress, tema y plugins.

---

## 6. Documentación y procesos (Complejo)

**Manual de instalación o despliegue**

Se incluirá en el repositorio un documento con instrucciones básicas de instalación siguiendo el proceso estándar de WordPress: descompresión de archivos, importación de la base de datos, configuración de wp-config.php, asignación de permisos y ajuste de URLs. No se requieren herramientas adicionales fuera del stack habitual de WordPress.

**Manual de mantenimiento o actualización**

No se cuenta con un manual específico. El mantenimiento se realiza conforme a las prácticas estándar de WordPress: actualización del core, temas y plugins desde el panel de administración. Se recomienda realizar un backup completo previo a cualquier actualización.

**Instrucciones de despliegue de staging a producción**

No aplica. El proyecto no cuenta con un flujo de staging → producción, ya que el sitio es informativo y no posee procesos críticos que lo requieran. La migración se realizará directamente al entorno productivo en AWS.

**Notas sobre personalizaciones del core o del tema**

No se han realizado modificaciones al core de WordPress. El sitio utiliza el tema Hello Elementor sin personalizaciones de código (no se utiliza child theme). El diseño y la funcionalidad se gestionan íntegramente mediante Elementor y Elementor Pro.

**Diagrama de arquitectura o flujos de integración**

No aplica. La arquitectura es estándar de WordPress (LAMP/LEMP) sin integraciones externas o flujos complejos que ameriten diagramación adicional.

**Dependencias del sistema y librerías externas**

No existen dependencias adicionales más allá de los requisitos estándar para WordPress 6.8.3, funcionando sobre PHP 8.4 y MySQL 8.0. No se utilizan librerías externas ni procesos de compilación de assets.

**Historial de cambios o versiones**

Se entregará el repositorio en su estado actual productivo. Este corresponde al primer entregable formal del proyecto, por lo que no existe un historial previo de versiones.

---

## 7. Repositorio y control de versiones (Complejo)

**Acceso al repositorio (GitHub, GitLab, Bitbucket).**  
R. El repositorio será proporcionado en la plataforma acordada con el cliente, actualmente vive en https://gitlab.com/e.cruz/ecoce-wp como respositorio privado. Se requiere que el cliente proporcione el correo electrónico del usuario o equipo que debe tener acceso para otorgar los permisos correspondientes.

**Instrucciones de cómo realizar despliegues (CI/CD si aplica).**  
R. No aplica. No hay pipeline de CI/CD configurado. El despliegue es manual mediante copia de archivos y base de datos al servidor de destino.

**Rama de producción y desarrollo.**  
R. El repositorio contiene una única rama principal (main/master) con la versión productiva del sitio. No se manejan ramas separadas de desarrollo o staging en este proyecto.