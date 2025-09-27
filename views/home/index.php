<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">
                    Encuentra tu <span style="color: var(--accent-color);">alojamiento perfecto</span>
                </h1>
                <p class="hero-subtitle">
                    Descubre experiencias únicas con nuestra selección curada de alojamientos
                    en El Salvador. Desde hoteles boutique hasta villas tropicales.
                </p>
                <?php if (!isset($_SESSION['usuario_id'])): ?>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="index.php?route=auth&action=register" class="btn btn-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                        </a>
                        <a href="index.php?route=auth&action=login" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                <?php else: ?>
                    <a href="index.php?route=user&action=dashboard" class="btn btn-light btn-lg">
                        <i class="fas fa-user-circle me-2"></i>Ver Mi Cuenta
                    </a>
                <?php endif; ?>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image mt-4 mt-lg-0">
                    <i class="fas fa-hotel" style="font-size: 8rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Estadísticas -->
<section class="py-4" style="background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-home text-primary me-3" style="font-size: 2rem;"></i>
                    <div>
                        <h4 class="mb-0"><?php echo count($alojamientos); ?>+</h4>
                        <p class="text-muted mb-0">Alojamientos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-star text-warning me-3" style="font-size: 2rem;"></i>
                    <div>
                        <h4 class="mb-0">4.8</h4>
                        <p class="text-muted mb-0">Calificación</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-users text-success me-3" style="font-size: 2rem;"></i>
                    <div>
                        <h4 class="mb-0">1000+</h4>
                        <p class="text-muted mb-0">Huéspedes Felices</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Alojamientos Destacados -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold mb-3">
                <span style="color: var(--primary-color);">Alojamientos</span> Destacados
            </h2>
            <p class="lead text-muted">
                Explora nuestra selección curada de los mejores alojamientos disponibles
            </p>
        </div>

        <?php if (empty($alojamientos)): ?>
            <div class="text-center py-5">
                <i class="fas fa-home text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                <h4 class="mt-3 text-muted">No hay alojamientos disponibles</h4>
                <p class="text-muted">Próximamente tendremos más opciones para ti</p>
            </div>
        <?php else: ?>
            <div class="row">
                <?php foreach ($alojamientos as $alojamiento): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>"
                                 class="card-img-top"
                                 alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                 style="height: 250px; object-fit: cover;">

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">
                                    <?php echo htmlspecialchars($alojamiento['nombre']); ?>
                                </h5>

                                <p class="card-text text-muted flex-grow-1">
                                    <?php echo htmlspecialchars($alojamiento['descripcion']); ?>
                                </p>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        <small class="text-muted">
                                            <?php echo htmlspecialchars($alojamiento['ubicacion']); ?>
                                        </small>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <span class="h4 text-primary mb-0">
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

                                <?php if (isset($_SESSION['usuario_id']) && $_SESSION['usuario_tipo'] !== 'admin'): ?>
                                    <form method="POST" action="index.php?route=user&action=select" class="mt-auto">
                                        <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento['id']; ?>">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-plus me-2"></i>Seleccionar Alojamiento
                                        </button>
                                    </form>
                                <?php elseif (!isset($_SESSION['usuario_id'])): ?>
                                    <a href="index.php?route=auth&action=login" class="btn btn-outline-primary w-100 mt-auto">
                                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión para Seleccionar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Características/Beneficios -->
<section class="py-5" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">¿Por qué elegirnos?</h2>
            <p class="lead text-muted">Ofrecemos la mejor experiencia en alojamientos</p>
        </div>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center p-4">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-search text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Fácil Selección</h5>
                    <p class="text-muted">
                        Explora y selecciona alojamientos de manera sencilla.
                        Nuestra plataforma intuitiva hace que encontrar el lugar perfecto sea muy fácil.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center p-4">
                    <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-shield-alt text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Calidad Garantizada</h5>
                    <p class="text-muted">
                        Todos nuestros alojamientos pasan por un riguroso proceso de selección
                        para garantizar la mejor calidad y experiencia.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center p-4">
                    <div class="bg-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-headset text-white" style="font-size: 2rem;"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Soporte 24/7</h5>
                    <p class="text-muted">
                        Nuestro equipo de soporte está disponible las 24 horas
                        para ayudarte con cualquier consulta o inconveniente.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<?php if (!isset($_SESSION['usuario_id'])): ?>
    <section class="py-5" style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);">
        <div class="container">
            <div class="text-center text-white">
                <h2 class="display-6 fw-bold mb-3">¿Listo para comenzar?</h2>
                <p class="lead mb-4 opacity-90">
                    Únete a miles de usuarios que ya disfrutan de nuestros alojamientos
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="index.php?route=auth&action=register" class="btn btn-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>Crear Cuenta Gratis
                    </a>
                    <a href="index.php?route=auth&action=login" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Ya tengo cuenta
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>