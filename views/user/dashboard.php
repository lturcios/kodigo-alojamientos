<!-- Hero Section Usuario -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="hero-title">
                    Bienvenido, <span style="color: var(--accent-color);"><?php echo htmlspecialchars($usuario_nombre); ?></span>
                </h1>
                <p class="hero-subtitle">
                    Gestiona tus alojamientos seleccionados y descubre nuevas opciones
                </p>
            </div>
            <div class="col-lg-4 text-center">
                <div class="stats-card bg-white rounded p-4 text-dark">
                    <h3 class="text-primary mb-0"><?php echo count($alojamientos_seleccionados); ?></h3>
                    <p class="mb-0">Alojamientos Seleccionados</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    <!-- Alojamientos Seleccionados -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="display-6 fw-bold mb-0">
                    <i class="fas fa-heart text-danger me-3"></i>Mis Alojamientos Seleccionados
                </h2>
                <?php if (count($alojamientos_seleccionados) > 0): ?>
                    <span class="badge bg-primary fs-6"><?php echo count($alojamientos_seleccionados); ?> seleccionados</span>
                <?php endif; ?>
            </div>

            <?php if (empty($alojamientos_seleccionados)): ?>
                <div class="card border-0 bg-light text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-heart-broken text-muted mb-3" style="font-size: 4rem; opacity: 0.3;"></i>
                        <h4 class="text-muted mb-3">No has seleccionado alojamientos aún</h4>
                        <p class="text-muted mb-4">
                            Explora nuestra selección de alojamientos disponibles y comienza a armar tu lista de favoritos.
                        </p>
                        <a href="#disponibles" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Explorar Alojamientos
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($alojamientos_seleccionados as $alojamiento): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-success">
                                <div class="position-relative">
                                    <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>"
                                         class="card-img-top"
                                         alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <span class="badge bg-success">
                                            <i class="fas fa-check me-1"></i>Seleccionado
                                        </span>
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <small class="badge bg-dark">
                                            <i class="fas fa-calendar me-1"></i>
                                            <?php echo date('d/m/Y', strtotime($alojamiento['fecha_seleccion'])); ?>
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
                                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                                            <small class="text-muted">
                                                <?php echo htmlspecialchars($alojamiento['ubicacion']); ?>
                                            </small>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="h5 text-success mb-0">
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

                                    <form method="POST" action="index.php?route=user&action=remove" class="mt-auto">
                                        <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento['id']; ?>">
                                        <button type="submit" class="btn btn-outline-danger w-100 btn-delete">
                                            <i class="fas fa-trash me-2"></i>Eliminar de mi Lista
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Separador -->
    <hr class="my-5" style="height: 3px; background: linear-gradient(90deg, var(--primary-color), var(--accent-color)); border: none; border-radius: 2px;">

    <!-- Alojamientos Disponibles -->
    <div class="row" id="disponibles">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h2 class="display-6 fw-bold mb-0">
                    <i class="fas fa-plus-circle text-primary me-3"></i>Alojamientos Disponibles
                </h2>
                <?php if (count($alojamientos_disponibles) > 0): ?>
                    <span class="badge bg-info fs-6"><?php echo count($alojamientos_disponibles); ?> disponibles</span>
                <?php endif; ?>
            </div>

            <?php if (empty($alojamientos_disponibles)): ?>
                <div class="card border-0 bg-light text-center py-5">
                    <div class="card-body">
                        <i class="fas fa-check-circle text-success mb-3" style="font-size: 4rem; opacity: 0.5;"></i>
                        <h4 class="text-success mb-3">¡Excelente!</h4>
                        <p class="text-muted mb-4">
                            Has seleccionado todos los alojamientos disponibles.
                            Mantente atento para nuevas opciones.
                        </p>
                        <a href="index.php" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Volver al Inicio
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-info border-0">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>¿Te interesa alguno?</strong> Haz clic en "Seleccionar" para agregarlo a tu lista personal.
                </div>

                <div class="row">
                    <?php foreach ($alojamientos_disponibles as $alojamiento): ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 border-primary border-opacity-25">
                                <img src="<?php echo htmlspecialchars($alojamiento['imagen']); ?>"
                                     class="card-img-top"
                                     alt="<?php echo htmlspecialchars($alojamiento['nombre']); ?>"
                                     style="height: 200px; object-fit: cover;">

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
                                                <span class="h5 text-primary mb-0">
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

                                    <form method="POST" action="index.php?route=user&action=select" class="mt-auto">
                                        <input type="hidden" name="alojamiento_id" value="<?php echo $alojamiento['id']; ?>">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-heart me-2"></i>Seleccionar Alojamiento
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Floating Action Button (FAB) -->
<?php if (count($alojamientos_seleccionados) > 0): ?>
    <div class="fab-container">
        <div class="fab bg-primary text-white" data-bs-toggle="tooltip" data-bs-placement="left" title="Resumen de selecciones">
            <i class="fas fa-list"></i>
            <span class="fab-badge"><?php echo count($alojamientos_seleccionados); ?></span>
        </div>
    </div>

    <style>
        .fab-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
        }

        .fab {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 20px rgba(79, 70, 229, 0.4);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 30px rgba(79, 70, 229, 0.6);
        }

        .fab-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .stats-card {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border: 2px solid rgba(79, 70, 229, 0.1);
        }

        @media (max-width: 768px) {
            .fab-container {
                bottom: 1rem;
                right: 1rem;
            }

            .fab {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
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

            // Smooth scroll to available accommodations
            const exploreBtn = document.querySelector('a[href="#disponibles"]');
            if (exploreBtn) {
                exploreBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('disponibles').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });
            }

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
        });
    </script>
<?php endif; ?>