<?php

/**
 * Template Name: Calculadora Custom
 * 
 * Template custom para la página de calculadora que usa header y footer de Elementor
 * pero permite contenido custom en el medio
 *
 * @package HelloElementor
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Añadir clase de body para Elementor
if (class_exists('\Elementor\Plugin')) {
    \Elementor\Plugin::$instance->frontend->add_body_class('elementor-template-full-width');
}

get_header();
?>



<main id="content" class="site-main calculadora-custom-content">
    <div class="calculadora-custom-content-container">
        <!-- Banner de la calculadora - Usa la misma estructura que el header -->
        <div class="calculadora-banner">
            <div class="header-inner calculadora-banner-inner">
                <div class="calculadora-banner-content">
                    <!-- Título del Banner -->
                    <h1 class="calculadora-banner-title">
                        Calculadora Ecológica de Reciclaje
                    </h1>
                </div>
            </div>
        </div>

        <!-- Bloque de bienvenida con Eco -->
        <!-- Contenedor verde sólido al 100% -->
        <div class="eco-welcome-block">
            <!-- Contenedor blanco interno -->
            <div class="eco-welcome-container">
                <!-- Personaje Eco a la izquierda -->
                <div class="eco-character">
                    <h2 class="eco-greeting" id="eco-greeting" style="display: none;">¡Hola!</h2>
                    <div class="eco-character-bg"></div>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/mascota.png" alt="Eco mascot" class="eco-mascot-img" id="eco-mascot-img">
                </div>

                <!-- Paso 1: Formulario de bienvenida -->
                <div class="eco-welcome-content eco-step" data-step="1">
                    <p class="eco-welcome-text">
                        Soy Eco, y voy ayudarte a calcular los beneficios medioambientales con los que contribuyes al reciclar envases y empaques que separas.
                    </p>

                    <form class="eco-welcome-form" id="eco-welcome-form">
                        <label for="eco-name" class="eco-form-label">Nombre:</label>
                        <input
                            type="text"
                            id="eco-name"
                            name="nombre"
                            class="eco-form-input"
                            placeholder="Ingresa tu nombre"
                            required>
                        <button type="submit" class="eco-form-button">
                            Comenzar
                        </button>
                    </form>
                </div>

                <!-- Paso 2: Formulario de cantidades -->
                <div class="eco-welcome-content eco-step" data-step="2" style="display: none;">
                    <p class="eco-instruction-text">
                        Ingresa la cantidad de envases y empaques de plásticos que acopias
                    </p>

                    <form class="eco-quantities-form" id="eco-quantities-form">
                        <div class="eco-inputs-grid">
                            <!-- PET -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pet.svg" alt="PET" class="eco-material-icon">
                                </div>
                                <label for="eco-pet" class="eco-material-label">PET:</label>
                                <input
                                    type="number"
                                    id="eco-pet"
                                    name="pet"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>

                            <!-- PEAD -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pead.svg" alt="PEAD" class="eco-material-icon">
                                </div>
                                <label for="eco-pead" class="eco-material-label">PEAD:</label>
                                <input
                                    type="number"
                                    id="eco-pead"
                                    name="pead"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>

                            <!-- POLI -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pebd.svg" alt="POLI" class="eco-material-icon">
                                </div>
                                <label for="eco-poli" class="eco-material-label">POLI:</label>
                                <input
                                    type="number"
                                    id="eco-poli"
                                    name="poli"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>

                            <!-- PP -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bopp.svg" alt="PP" class="eco-material-icon">
                                </div>
                                <label for="eco-pp" class="eco-material-label">PP:</label>
                                <input
                                    type="number"
                                    id="eco-pp"
                                    name="pp"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>
                        </div>

                        <button type="submit" class="eco-form-button eco-continue-button">
                            Continuar
                        </button>
                    </form>
                </div>

                <!-- Paso 3: Formulario de cartón multilaminado y vidrio -->
                <div class="eco-welcome-content eco-step" data-step="3" style="display: none;">
                    <p class="eco-instruction-text">
                        Toca el turno de cartón multilaminado y vidrio
                    </p>

                    <form class="eco-quantities-form" id="eco-carton-vidrio-form">
                        <div class="eco-inputs-grid eco-inputs-grid-2">
                            <!-- Cartón Multilaminado -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/carton_multilaminado.svg" alt="Cartón Multilaminado" class="eco-material-icon">
                                </div>
                                <label for="eco-carton" class="eco-material-label">Cartón Multilaminado:</label>
                                <input
                                    type="number"
                                    id="eco-carton"
                                    name="carton_multilaminado"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>

                            <!-- Vidrio -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vidrio.svg" alt="Vidrio" class="eco-material-icon">
                                </div>
                                <label for="eco-vidrio" class="eco-material-label">Vidrio</label>
                                <input
                                    type="number"
                                    id="eco-vidrio"
                                    name="vidrio"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>
                        </div>

                        <button type="submit" class="eco-form-button eco-continue-button">
                            Continuar
                        </button>
                    </form>
                </div>

                <!-- Paso 4: Formulario de envases metálicos -->
                <div class="eco-welcome-content eco-step" data-step="4" style="display: none;">
                    <p class="eco-instruction-text">
                        ¿Qué tal te fue separando con los envases y empaques metálicos?
                    </p>

                    <form class="eco-quantities-form" id="eco-metalicos-form">
                        <div class="eco-inputs-grid eco-inputs-grid-2">
                            <!-- Latas de Aluminio -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/aluminio.svg" alt="Latas de Aluminio" class="eco-material-icon">
                                </div>
                                <label for="eco-aluminio" class="eco-material-label">Latas de aluminio</label>
                                <input
                                    type="number"
                                    id="eco-aluminio"
                                    name="latas_aluminio"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>

                            <!-- Latas de Hojalata -->
                            <div class="eco-input-box">
                                <div class="eco-input-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hojalata.svg" alt="Latas de Hojalata" class="eco-material-icon">
                                </div>
                                <label for="eco-hojalata" class="eco-material-label">Latas de hojalata</label>
                                <input
                                    type="number"
                                    id="eco-hojalata"
                                    name="latas_hojalata"
                                    class="eco-material-input"
                                    min="0"
                                    step="0.01"
                                    required>
                                <span class="eco-material-unit">kg</span>
                            </div>
                        </div>

                        <button type="submit" class="eco-form-button eco-continue-button">
                            Continuar
                        </button>
                    </form>
                </div>

                <!-- Paso 5: Resumen de información (solo lectura) -->
                <div class="eco-welcome-content eco-step" data-step="5" style="display: none;">
                    <div class="eco-summary-header">
                        <h2 class="eco-summary-title" id="eco-summary-title">Felicidades</h2>
                        <p class="eco-summary-subtitle">Por tu compromiso con el medio ambiente</p>
                    </div>

                    <div class="eco-inputs-grid eco-inputs-grid-summary">
                        <!-- PET -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pet.svg" alt="PET" class="eco-material-icon">
                            </div>
                            <label for="eco-pet-summary" class="eco-material-label">PET:</label>
                            <input
                                type="text"
                                id="eco-pet-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- PEAD -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pead.svg" alt="PEAD" class="eco-material-icon">
                            </div>
                            <label for="eco-pead-summary" class="eco-material-label">PEAD:</label>
                            <input
                                type="text"
                                id="eco-pead-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- POLI -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pebd.svg" alt="POLI" class="eco-material-icon">
                            </div>
                            <label for="eco-poli-summary" class="eco-material-label">POLI:</label>
                            <input
                                type="text"
                                id="eco-poli-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- PP -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bopp.svg" alt="PP" class="eco-material-icon">
                            </div>
                            <label for="eco-pp-summary" class="eco-material-label">PP:</label>
                            <input
                                type="text"
                                id="eco-pp-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- Cartón Multilaminado -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/carton_multilaminado.svg" alt="Cartón Multilaminado" class="eco-material-icon">
                            </div>
                            <label for="eco-carton-summary" class="eco-material-label">Cartón Multilaminado:</label>
                            <input
                                type="text"
                                id="eco-carton-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- Vidrio -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/vidrio.svg" alt="Vidrio" class="eco-material-icon">
                            </div>
                            <label for="eco-vidrio-summary" class="eco-material-label">Vidrio</label>
                            <input
                                type="text"
                                id="eco-vidrio-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- Latas de Aluminio -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/aluminio.svg" alt="Latas de Aluminio" class="eco-material-icon">
                            </div>
                            <label for="eco-aluminio-summary" class="eco-material-label">Latas de aluminio</label>
                            <input
                                type="text"
                                id="eco-aluminio-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>

                        <!-- Latas de Hojalata -->
                        <div class="eco-input-box">
                            <div class="eco-input-icon">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hojalata.svg" alt="Latas de Hojalata" class="eco-material-icon">
                            </div>
                            <label for="eco-hojalata-summary" class="eco-material-label">Latas de hojalata</label>
                            <input
                                type="text"
                                id="eco-hojalata-summary"
                                class="eco-material-input eco-material-input-readonly"
                                readonly>
                            <span class="eco-material-unit">kg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bloque de Beneficios Medioambientales -->
        <div class="eco-benefits-block" id="eco-benefits-block" style="display: none;">
            <div class="eco-benefits-container">
                <h2 class="eco-benefits-title">Beneficios medioambientales</h2>
                <p class="eco-benefits-description" id="eco-benefits-description">
                    Tus <span id="eco-total-kg">0</span> kg de residuos de envases y empaques separados y reciclados generan los siguientes beneficios medioambientales:
                </p>

                <div class="eco-benefits-grid">
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/refrigerador.png" alt="Refrigerador" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Ahorra la energía equivalente para mantener encendido 1 refrigerador durante</div>
                        <div class="eco-benefit-value" id="eco-benefit-refrigerador">0</div>
                        <div class="eco-benefit-unit">Días y noches</div>
                    </div>
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/combustible.png" alt="Combustible" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Ahorra el combustible necesario para recorrer</div>
                        <div class="eco-benefit-value" id="eco-benefit-km">0</div>
                        <div class="eco-benefit-unit">km en auto</div>
                    </div>
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ciudad.png" alt="Ciudad" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Evita la emisión de <span id="eco-benefit-co2">0</span> kg de CO2 (gas de efecto invernadero) a la atmósfera, lo que contribuye a combatir el cambio climático global</div>
                        <div class="eco-benefit-value" id="eco-benefit-co2-value">0</div>
                        <div class="eco-benefit-unit">kg de CO2</div>
                    </div>
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/agua.png" alt="Agua" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Ahorra el agua promedio que toma una persona durante</div>
                        <div class="eco-benefit-value" id="eco-benefit-agua">0</div>
                        <div class="eco-benefit-unit">Días</div>
                    </div>
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arboles.png" alt="Árboles" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Evita que se talen</div>
                        <div class="eco-benefit-value" id="eco-benefit-arboles">0</div>
                        <div class="eco-benefit-unit">Árboles</div>
                    </div>
                    <div class="eco-benefit-item">
                        <div class="eco-benefit-image-placeholder">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/basura_dos.png" alt="Basura" class="eco-benefit-img">
                        </div>
                        <div class="eco-benefit-text">Es equivalente a llenar</div>
                        <div class="eco-benefit-value" id="eco-benefit-camiones">0</div>
                        <div class="eco-benefit-unit">Camiones de basura</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bloque de Mensaje Motivacional -->
    <div class="eco-motivational-block" id="eco-motivational-block" style="display: none;">
        <div class="eco-motivational-container">
            <div class="eco-motivational-box">
                <p class="eco-motivational-text">
                    "Mejora tus resultados periódicamente al separar tus residuos y canalizarlos a reciclaje"
                </p>
            </div>
        </div>
    </div>

    <!-- Bloque de Tips -->
    <div class="eco-tips-block" id="eco-tips-block" style="display: none;">
        <div class="eco-tips-container">
            <h2 class="eco-tips-title">Algunos tips para ayudar mucho más</h2>

            <div class="eco-tips-grid">
                <!-- Tip 1 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">1</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Separa los residuos que generas en tu hogar para entregarlos al camión recolector de tu colonia</p>
                    </div>
                </div>

                <!-- Tip 2 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">2</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Solo compra los alimentos que lograras terminar</p>
                    </div>
                </div>

                <!-- Tip 3 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">3</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Evita desperdiciar alimentos</p>
                    </div>
                </div>

                <!-- Tip 4 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">4</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Arregla tus aparatos eléctricos y electrodomésticos</p>
                    </div>
                </div>

                <!-- Tip 5 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">5</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Evita el uso de productos desechables, asegurate que sean reciclables</p>
                    </div>
                </div>

                <!-- Tip 6 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">6</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Consume preferentemente productos con envases y empaques reciclables o reciclados</p>
                    </div>
                </div>

                <!-- Tip 7 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">7</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Elige bienes y servicios que favorezcan la conservación del medio ambiente</p>
                    </div>
                </div>

                <!-- Tip 8 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">8</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Investiga el origen de los productos que consumes para evaluar tu huella ambiental</p>
                    </div>
                </div>

                <!-- Tip 9 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">9</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Investiga cuál es el tratamiento local de los residuos que generas en casa</p>
                    </div>
                </div>

                <!-- Tip 10 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">10</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Rechaza productos y servicios donde exista explotación infantil</p>
                    </div>
                </div>

                <!-- Tip 11 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">11</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Elige calidad y no cantidad</p>
                    </div>
                </div>

                <!-- Tip 12 -->
                <div class="eco-tip-item">
                    <div class="eco-tip-number">12</div>
                    <div class="eco-tip-box">
                        <p class="eco-tip-text">Identifica en tu colonia centros de reciclaje para llevar tus envases y empaques post consumo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bloque Final -->
    <div class="eco-final-block" id="eco-final-block" style="display: none;">
        <div class="eco-final-container">
            <div class="eco-final-content">
                <p class="eco-final-text">
                    Gracias por fomentar la recuperación y reciclaje de los residuos de envases y empaques.
                </p>
                <p class="eco-final-text">
                    Al reconocer el valor de estos materiales estas permitiendo se reincorporen a nuevos procesos y se conviertan en nuevos productos.
                </p>
                <div class="eco-final-button-container">
                    <button class="eco-final-button" id="eco-restart-button">Empezar de nuevo</button>
                </div>
            </div>
        </div>
    </div>
</main>



<script>
    // Variables globales para almacenar los datos
    const calculadoraData = {
        nombre: '',
        pet: 0,
        pead: 0,
        poli: 0,
        pp: 0,
        carton_multilaminado: 0,
        vidrio: 0,
        latas_aluminio: 0,
        latas_hojalata: 0
    };

    // Función para cambiar de paso
    function cambiarPaso(pasoActual, siguientePaso) {
        const pasoActualEl = document.querySelector(`.eco-step[data-step="${pasoActual}"]`);
        const siguientePasoEl = document.querySelector(`.eco-step[data-step="${siguientePaso}"]`);

        if (pasoActualEl && siguientePasoEl) {
            pasoActualEl.style.display = 'none';
            siguientePasoEl.style.display = 'flex';
        }
    }

    // Función para cambiar imagen con animación suave
    function cambiarImagenConAnimacion(nuevaSrc) {
        const mascotImg = document.getElementById('eco-mascot-img');
        if (!mascotImg) return;

        // Agregar clase de fade out
        mascotImg.classList.add('fade-out');

        // Después de la animación de fade out, cambiar la imagen
        setTimeout(function() {
            mascotImg.src = nuevaSrc;
            // Remover fade-out y agregar fade-in
            mascotImg.classList.remove('fade-out');
            mascotImg.classList.add('fade-in');

            // Remover fade-in después de la animación
            setTimeout(function() {
                mascotImg.classList.remove('fade-in');
            }, 300);
        }, 300);
    }

    // Formulario de bienvenida (Paso 1)
    document.addEventListener('DOMContentLoaded', function() {
        const welcomeForm = document.getElementById('eco-welcome-form');

        if (welcomeForm) {
            welcomeForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const nombreInput = document.getElementById('eco-name');
                if (nombreInput && nombreInput.value.trim() !== '') {
                    // Guardar nombre en variable
                    calculadoraData.nombre = nombreInput.value.trim();

                    // Actualizar saludo y mostrarlo
                    const greetingEl = document.getElementById('eco-greeting');
                    if (greetingEl) {
                        greetingEl.textContent = `¡Hola ${calculadoraData.nombre}!`;
                        greetingEl.style.display = 'block';
                    }

                    // Cambiar imagen del personaje con animación
                    cambiarImagenConAnimacion('<?php echo get_template_directory_uri(); ?>/assets/images/mascota_2.png');

                    // Cambiar al siguiente paso
                    cambiarPaso(1, 2);
                }
            });
        }

        // Formulario de cantidades (Paso 2)
        const quantitiesForm = document.getElementById('eco-quantities-form');

        if (quantitiesForm) {
            quantitiesForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Guardar valores en variables
                calculadoraData.pet = parseFloat(document.getElementById('eco-pet').value) || 0;
                calculadoraData.pead = parseFloat(document.getElementById('eco-pead').value) || 0;
                calculadoraData.poli = parseFloat(document.getElementById('eco-poli').value) || 0;
                calculadoraData.pp = parseFloat(document.getElementById('eco-pp').value) || 0;

                // Actualizar saludo a "¡Muy bien!"
                const greetingEl = document.getElementById('eco-greeting');
                if (greetingEl) {
                    greetingEl.textContent = '¡Muy bien!';
                }

                // Cambiar imagen del personaje con animación
                cambiarImagenConAnimacion('<?php echo get_template_directory_uri(); ?>/assets/images/basura.png');

                // Asegurar que la imagen no esté invertida en el paso 3
                const mascotImg = document.getElementById('eco-mascot-img');
                if (mascotImg) {
                    mascotImg.style.transform = 'scaleX(1)';
                }

                // Cambiar al siguiente paso
                cambiarPaso(2, 3);
            });
        }

        // Formulario de cartón multilaminado y vidrio (Paso 3)
        const cartonVidrioForm = document.getElementById('eco-carton-vidrio-form');

        if (cartonVidrioForm) {
            cartonVidrioForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Guardar valores en variables
                calculadoraData.carton_multilaminado = parseFloat(document.getElementById('eco-carton').value) || 0;
                calculadoraData.vidrio = parseFloat(document.getElementById('eco-vidrio').value) || 0;

                // Actualizar saludo a "La última"
                const greetingEl = document.getElementById('eco-greeting');
                if (greetingEl) {
                    greetingEl.textContent = 'La última';
                }

                // Invertir imagen del personaje (misma imagen pero invertida)
                const mascotImg = document.getElementById('eco-mascot-img');
                if (mascotImg) {
                    mascotImg.style.transform = 'scaleX(-1)';
                }

                // Cambiar al siguiente paso
                cambiarPaso(3, 4);
            });
        }

        // Formulario de envases metálicos (Paso 4)
        const metalicosForm = document.getElementById('eco-metalicos-form');

        if (metalicosForm) {
            metalicosForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Guardar valores en variables
                calculadoraData.latas_aluminio = parseFloat(document.getElementById('eco-aluminio').value) || 0;
                calculadoraData.latas_hojalata = parseFloat(document.getElementById('eco-hojalata').value) || 0;

                // Actualizar resumen en el paso 5
                actualizarResumen();

                // Calcular y mostrar total de kg
                calcularTotalKg();

                // Calcular beneficios medioambientales
                const beneficios = calcularBeneficiosMedioambientales();

                // Guardar datos en la base de datos
                guardarDatosCalculadora(beneficios);

                // Mostrar bloque de beneficios
                mostrarBloqueBeneficios();

                // Mostrar bloque motivacional
                mostrarBloqueMotivacional();

                // Mostrar bloque de tips
                mostrarBloqueTips();

                // Mostrar bloque final
                mostrarBloqueFinal();

                // Volver a la imagen del paso 1 con animación
                cambiarImagenConAnimacion('<?php echo get_template_directory_uri(); ?>/assets/images/mascota.png');

                // Quitar la inversión de la imagen si está aplicada
                const mascotImg = document.getElementById('eco-mascot-img');
                if (mascotImg) {
                    mascotImg.style.transform = 'scaleX(1)';
                }

                // Cambiar al siguiente paso
                cambiarPaso(4, 5);
            });
        }
    });

    // Función para actualizar el resumen en el paso 5
    function actualizarResumen() {
        // Actualizar título con el nombre
        const summaryTitle = document.getElementById('eco-summary-title');
        if (summaryTitle && calculadoraData.nombre) {
            summaryTitle.textContent = `Felicidades ${calculadoraData.nombre}`;
        }

        // Actualizar todos los campos de resumen
        document.getElementById('eco-pet-summary').value = calculadoraData.pet || 0;
        document.getElementById('eco-pead-summary').value = calculadoraData.pead || 0;
        document.getElementById('eco-poli-summary').value = calculadoraData.poli || 0;
        document.getElementById('eco-pp-summary').value = calculadoraData.pp || 0;
        document.getElementById('eco-carton-summary').value = calculadoraData.carton_multilaminado || 0;
        document.getElementById('eco-vidrio-summary').value = calculadoraData.vidrio || 0;
        document.getElementById('eco-aluminio-summary').value = calculadoraData.latas_aluminio || 0;
        document.getElementById('eco-hojalata-summary').value = calculadoraData.latas_hojalata || 0;
    }

    // Función para calcular el total de kg
    function calcularTotalKg() {
        const total =
            (calculadoraData.pet || 0) +
            (calculadoraData.pead || 0) +
            (calculadoraData.poli || 0) +
            (calculadoraData.pp || 0) +
            (calculadoraData.carton_multilaminado || 0) +
            (calculadoraData.vidrio || 0) +
            (calculadoraData.latas_aluminio || 0) +
            (calculadoraData.latas_hojalata || 0);

        const totalKgEl = document.getElementById('eco-total-kg');
        if (totalKgEl) {
            totalKgEl.textContent = total.toFixed(2);
        }
    }

    // Función para calcular todos los beneficios medioambientales
    function calcularBeneficiosMedioambientales() {
        // Convertir kg a toneladas (dividir entre 1000)
        const pet_t = (calculadoraData.pet || 0) / 1000;
        const pead_t = (calculadoraData.pead || 0) / 1000;
        const pebd_t = (calculadoraData.poli || 0) / 1000; // poli = pebd
        const bopp_t = (calculadoraData.pp || 0) / 1000; // pp = bopp
        const carton_t = (calculadoraData.carton_multilaminado || 0) / 1000;
        const vidrio_t = (calculadoraData.vidrio || 0) / 1000;
        const aluminio_t = (calculadoraData.latas_aluminio || 0) / 1000;
        const hojalata_kg = calculadoraData.latas_hojalata || 0; // NO se divide entre 1000

        // 1. REFRIGERADOR: Días equivalentes de energía
        const refrigerador =
            ((15277.8 * pet_t) / 0.964) +
            ((pebd_t * 18502.78) / 0.964) +
            (18197 * bopp_t / 0.964) +
            ((aluminio_t * 21000) / 0.964) +
            ((vidrio_t * 1600) / 0.964) +
            ((3675 * carton_t) / 0.964);

        // 2. ÁRBOLES: Solo cartón multilaminado evita tala
        const arboles = 13.5 * carton_t;

        // 3. CAMIONES DE BASURA: Equivalente en camiones
        const camiones =
            ((43.9 * pet_t) / 10) +
            ((30.487 * pead_t) / 10) +
            ((23.75 * pebd_t) / 10) +
            ((36.63 * bopp_t) / 10) +
            ((33.3 * aluminio_t) / 10) +
            ((37.45 * hojalata_kg / 1000) / 10) +
            ((3.844 * vidrio_t) / 10) +
            ((21 * carton_t) / 10);

        // 4. DÍAS DE AGUA: Ahorro de agua equivalente
        const dias_agua =
            (4900 * pead_t / 2.5) +
            (3930 * bopp_t / 2.5) +
            (90000 * aluminio_t / 2.5) +
            (24375 * carton_t / 2.5);

        // 5. KM EN AUTO: Equivalente en kilómetros
        const km_auto =
            ((pet_t * 4.44) * 66 * 20.09) +
            ((pead_t * 4.44) * 66 * 20.09) +
            ((pebd_t * 4.44) * 66 * 20.09) +
            ((bopp_t * 4.44) * 66 * 20.09) +
            ((9.43 * carton_t) * 66 * 20.09);

        // 6. CO2: Kilogramos de dióxido de carbono evitados
        const kg_co2 =
            (1870 * pet_t) +
            (1330 * pead_t) +
            (1294 * pebd_t) +
            (1310 * bopp_t) +
            (6900 * aluminio_t) +
            (1.5 * hojalata_kg) + // hojalata NO se divide entre 1000
            (166 * vidrio_t) +
            (857 * carton_t);

        // Actualizar los valores en el DOM
        actualizarValorBeneficio('eco-benefit-refrigerador', refrigerador, 0);
        actualizarValorBeneficio('eco-benefit-arboles', arboles, 0);
        actualizarValorBeneficio('eco-benefit-camiones', camiones, 0);
        actualizarValorBeneficio('eco-benefit-agua', dias_agua, 0);
        actualizarValorBeneficio('eco-benefit-km', km_auto, 0);
        actualizarValorBeneficio('eco-benefit-co2-value', kg_co2, 0);

        // Actualizar CO2 en el texto descriptivo también
        const co2TextElement = document.getElementById('eco-benefit-co2');
        if (co2TextElement) {
            co2TextElement.textContent = formatearNumero(kg_co2, 0);
        }

        // Retornar los valores calculados para guardarlos
        return {
            refrigerador: refrigerador,
            arboles: arboles,
            camiones: camiones,
            dias_agua: dias_agua,
            km_auto: km_auto,
            kg_co2: kg_co2
        };
    }

    // Función auxiliar para actualizar valores de beneficios con formato
    function actualizarValorBeneficio(elementId, value, decimals) {
        const element = document.getElementById(elementId);
        if (element) {
            element.textContent = formatearNumero(value, decimals);
        }
    }

    // Función para formatear números con comas
    function formatearNumero(numero, decimals) {
        return numero.toFixed(decimals).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    // Función para guardar datos en la base de datos
    function guardarDatosCalculadora(beneficios) {
        // Calcular total
        const total =
            (calculadoraData.pet || 0) +
            (calculadoraData.pead || 0) +
            (calculadoraData.poli || 0) +
            (calculadoraData.pp || 0) +
            (calculadoraData.carton_multilaminado || 0) +
            (calculadoraData.vidrio || 0) +
            (calculadoraData.latas_aluminio || 0) +
            (calculadoraData.latas_hojalata || 0);

        // Preparar datos para enviar
        const datos = {
            action: 'save_calculadora_data',
            nonce: calculadoraAjax.nonce,
            nombre: calculadoraData.nombre,
            pet: calculadoraData.pet || 0,
            pead: calculadoraData.pead || 0,
            poli: calculadoraData.poli || 0,
            pp: calculadoraData.pp || 0,
            carton_multilaminado: calculadoraData.carton_multilaminado || 0,
            vidrio: calculadoraData.vidrio || 0,
            latas_aluminio: calculadoraData.latas_aluminio || 0,
            latas_hojalata: calculadoraData.latas_hojalata || 0,
            total: total,
            refrigerador: beneficios.refrigerador || 0,
            arboles_cortados: beneficios.arboles || 0,
            camiones_basura: beneficios.camiones || 0,
            dias_agua: beneficios.dias_agua || 0,
            km_en_auto: beneficios.km_auto || 0,
            kg_de_co2: beneficios.kg_co2 || 0
        };

        // Enviar datos vía AJAX
        jQuery.ajax({
            url: calculadoraAjax.ajax_url,
            type: 'POST',
            data: datos,
            success: function(response) {
                if (response.success) {
                    console.log('Datos guardados correctamente:', response.data);
                } else {
                    console.error('Error al guardar:', response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la petición AJAX:', error);
            }
        });
    }

    // Función para mostrar el bloque de beneficios
    function mostrarBloqueBeneficios() {
        const benefitsBlock = document.getElementById('eco-benefits-block');
        if (benefitsBlock) {
            benefitsBlock.style.display = 'block';
        }
    }

    // Función para mostrar el bloque motivacional
    function mostrarBloqueMotivacional() {
        const motivationalBlock = document.getElementById('eco-motivational-block');
        if (motivationalBlock) {
            motivationalBlock.style.display = 'block';
        }
    }

    // Función para mostrar el bloque de tips
    function mostrarBloqueTips() {
        const tipsBlock = document.getElementById('eco-tips-block');
        if (tipsBlock) {
            tipsBlock.style.display = 'block';
        }
    }

    // Función para mostrar el bloque final
    function mostrarBloqueFinal() {
        const finalBlock = document.getElementById('eco-final-block');
        if (finalBlock) {
            finalBlock.style.display = 'block';

            // Agregar event listener al botón cuando se muestra el bloque
            const restartButton = document.getElementById('eco-restart-button');
            if (restartButton) {
                restartButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Recargar la página para empezar de nuevo
                    window.location.reload();
                });
            }
        }
    }

    // Botón para empezar de nuevo (event delegation para asegurar que funcione)
    document.addEventListener('DOMContentLoaded', function() {
        // Usar event delegation para capturar clicks en el botón
        document.addEventListener('click', function(e) {
            if (e.target && e.target.id === 'eco-restart-button') {
                e.preventDefault();
                window.location.reload();
            }
        });
    });
</script>

<?php
get_footer();
