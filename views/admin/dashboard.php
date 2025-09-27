<!-- Hero Section Admin -->
<section class="hero-section" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">
                    <i class="fas fa-shield-alt me-3"></i>Panel de <span style="color: #fbbf24;">Administrador</span>
                </h1>
                <p class="hero-subtitle">
                    Gestiona los alojamientos disponibles en la plataforma
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="stats-card bg-white rounded p-4 text-dark">
                    <h3 class="text-danger mb-0"><?php echo count($alojamientos); ?></h3>
                    <p class="mb-0">Alojamientos Registrados</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <!-- Formulario para Agregar Alojamiento -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Agregar Nuevo Alojamiento
                    </h3>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?route=admin&action=add" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label fw-semibold">
                                        <i class="fas fa-hotel text-primary me-2"></i>Nombre del Alojamiento *
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg"
                                           id="nombre"
                                           name="nombre"
                                           required
                                           value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>"
                                           placeholder="Hotel Plaza Central">
                                    <div class="invalid-feedback">
                                        Por favor, ingresa el nombre del alojamiento.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ubicacion" class="form-label fw-semibold">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>Ubicación *
                                    </label>
                                    <input type="text"
                                           class="form-control form-control-lg"
                                           id="ubicacion"
                                           name="ubicacion"
                                           required
                                           value="<?php echo htmlspecialchars($_POST['ubicacion'] ?? ''); ?>"
                                           placeholder="Centro Histórico, San Salvador">
                                    <div class="invalid-feedback">
                                        Por favor, ingresa la ubicación.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-primary me-2"></i>Descripción *
                            </label>
                            <textarea class="form-control"
                                      id="descripcion"
                                      name="descripcion"
                                      rows="3"
                                      required
                                      placeholder="Describe las características y comodidades del alojamiento..."><?php echo htmlspecialchars($_POST['descripcion'] ?? ''); ?></textarea>
                            <div class="invalid-feedback">
                                Por favor, ingresa una descripción.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="precio" class="form-label fw-semibold">
                                        <i class="fas fa-dollar-sign text-primary me-2"></i>Precio por Noche (USD) *
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number"
                                               class="form-control form-control-lg"
                                               id="precio"
                                               name="precio"
                                               step="0.01"
                                               min="0"
                                               required
                                               value="<?php echo htmlspecialchars($_POST['precio'] ?? ''); ?>"
                                               placeholder="120.00">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor, ingresa un precio válido.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="imagen" class="form-label fw-semibold">
                                        <i class="fas fa-image text-primary me-2"></i>URL de Imagen
                                    </label>
                                    <input type="url"
                                           class="form-control form-control-lg"
                                           id="imagen"
                                           name="imagen"
                                           value="<?php echo htmlspecialchars($_POST['imagen'] ?? ''); ?>"
                                           placeholder="https://ejemplo.com/imagen.jpg">
                                    <small class="form-text text-muted">
                                        Si no se proporciona, se usará una imagen por defecto
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-secondary btn-lg me-md-2">
                                <i class="fas fa-times me-2"></i>Limpiar
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-plus me-2"></i>Agregar Alojamiento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Separador -->
    <hr class="my-5" style="height: 3px; background: linear-gradient(90deg, #dc2626, #991b1b); border: none; border-radius: 2px;">

    <!-- Lista de Alojamientos Existentes -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="display-6 fw-bold mb-0">
                    <i class="fas fa-list text-danger me-3"></i>Alojamientos Registrados
                </h2>
                <?php if (count($alojamientos) > 0): ?>
                    <span class="badge bg-danger fs-6"><?php echo count($alojamientos); ?> registrados</span>
                <?php endif; ?>
            </div>

            <?php if (empty($alojamientos)): ?>
                <div class="card border-0 bg-light text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-hotel text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h4 class="text-muted mb-3">No hay alojamientos registrados</h4>
                        <p class="text-muted mb-4">
                            Agrega el primer alojamiento usando el formulario de arriba.
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Nota:</strong> Como administrador, solo puedes agregar alojamientos. Los usuarios pueden seleccionar y eliminar alojamientos de sus cuentas.
                </div>

                <div class="row">
                    <?php foreach ($alojamientos as $alojamiento): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-danger border-opacity-25">
                                <div class="position-relative">
                                    <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>"
                                         class="card-img-top"
                                         alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <span class="badge bg-danger">
                                            <i class="fas fa-shield-alt me-1"></i>Admin
                                        </span>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <small class="badge bg-dark">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?php echo date('d/m/Y', strtotime($alojamiento['fecha_creacion'])); ?>
                                        </small>
                                    </div>
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-2">
                                        <?php echo htmlspecialchars($alojamiento['nombre']); ?>
                                    </h5>

                                    <p class="card-text text-muted flex-grow-1">
                                        <?php echo htmlspecialchars($alojamiento['descripcion']); ?>
                                    </p>

                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars($alojamiento['ubicacion']); ?>
                                            </small>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="h5 text-danger mb-0">
                                                    $<?php echo number_format($alojamiento['precio'], 2); ?>
                                                </span>
                                                <small class="text-muted">/noche</small>
                                            </div>

                                            <div class="rating">
                                                <?php for($i = 0; $i < 5; $i++): ?>
                                                    <i class="fas fa-star text-warning"></i>
                                                <?php endfor; ?>
                                                <small class="text-muted ms-1">(4.8)</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <div class="btn btn-outline-secondary w-100 disabled">
                                            <i class="fas fa-check-circle me-2"></i>Alojamiento Activo
                                        </div>
                                        <small class="text-muted d-block text-center mt-2">
                                            ID: <?php echo $alojamiento['id']; ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Info Card Flotante -->
<div class="info-card-container">
    <div class="info-card bg-danger text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Panel de Admin">
        <i class="fas fa-shield-alt"></i>
        <div class="info-badge">Admin</div>
    </div>
</div>

<style>
    .info-card-container {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
    }

    .info-card {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
        position: relative;
        animation: pulse 2s infinite;
    }

    .info-badge {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        background: #fbbf24;
        color: #7c2d12;
        border-radius: 10px;
        padding: 2px 6px;
        font-size: 0.6rem;
        font-weight: bold;
        white-space: nowrap;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
        }
        50% {
            box-shadow: 0 4px 30px rgba(220, 38, 38, 0.7);
        }
        100% {
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.4);
        }
    }

    .stats-card {
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border: 2px solid rgba(220, 38, 38, 0.1);
    }

    @media (max-width: 768px) {
        .info-card-container {
            bottom: 1rem;
            right: 1rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Form validation
        const form = document.querySelector('form');
        const nombreInput = document.getElementById('nombre');
        const descripcionInput = document.getElementById('descripcion');
        const precioInput = document.getElementById('precio');
        const ubicacionInput = document.getElementById('ubicacion');
        const imagenInput = document.getElementById('imagen');

        function showError(input, message) {
            input.classList.add('is-invalid');
            const feedback = input.parentNode.querySelector('.invalid-feedback') ||
                input.nextElementSibling;
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = message;
            }
        }

        function clearError(input) {
            input.classList.remove('is-invalid');
        }

        function validateURL(string) {
            try {
                new URL(string);
                return true;
            } catch (_) {
                return false;
            }
        }

        // Real-time validation
        [nombreInput, descripcionInput, ubicacionInput].forEach(input => {
            input.addEventListener('input', function() {
                clearError(this);
            });
        });

        precioInput.addEventListener('input', function() {
            clearError(this);
            if (this.value && (isNaN(this.value) || parseFloat(this.value) <= 0)) {
                showError(this, 'El precio debe ser un número mayor a 0.');
            }
        });

        imagenInput.addEventListener('input', function() {
            clearError(this);
            if (this.value && !validateURL(this.value)) {
                showError(this, 'Por favor, ingresa una URL válida.');
            }
        });

        // Form submission validation
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate required fields
            if (!nombreInput.value.trim()) {
                showError(nombreInput, 'El nombre es requerido.');
                isValid = false;
            } else {
                clearError(nombreInput);
            }

            if (!descripcionInput.value.trim()) {
                showError(descripcionInput, 'La descripción es requerida.');
                isValid = false;
            } else {
                clearError(descripcionInput);
            }

            if (!ubicacionInput.value.trim()) {
                showError(ubicacionInput, 'La ubicación es requerida.');
                isValid = false;
            } else {
                clearError(ubicacionInput);
            }

            // Validate precio
            if (!precioInput.value) {
                showError(precioInput, 'El precio es requerido.');
                isValid = false;
            } else if (isNaN(precioInput.value) || parseFloat(precioInput.value) <= 0) {
                showError(precioInput, 'El precio debe ser un número mayor a 0.');
                isValid = false;
            } else {
                clearError(precioInput);
            }

            // Validate imagen URL if provided
            if (imagenInput.value && !validateURL(imagenInput.value)) {
                showError(imagenInput, 'Por favor, ingresa una URL válida.');
                isValid = false;
            } else {
                clearError(imagenInput);
            }

            if (!isValid) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

        // Reset button functionality
        const resetBtn = document.querySelector('button[type="reset"]');
        resetBtn.addEventListener('click', function() {
            // Clear all validation states
            document.querySelectorAll('.is-invalid').forEach(input => {
                input.classList.remove('is-invalid');
            });
        });

        // Animate cards on scroll
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '0';
                        entry.target.style.transform = 'translateY(30px)';

                        setTimeout(() => {
                            entry.target.style.transition = 'all 0.6s ease';
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, 100);

                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1 }
        );

        document.querySelectorAll('.card').forEach((card) => {
            observer.observe(card);
        });

        // Auto-format price input
        precioInput.addEventListener('blur', function() {
            if (this.value && !isNaN(this.value)) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });
    });
</script>