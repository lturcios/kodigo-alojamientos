</main>

<footer class="mt-5 py-4" style="background: linear-gradient(135deg, var(--dark-color) 0%, #111827 100%); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="mb-3">
                    <i class="fas fa-home me-2"></i>Alojamientos App
                </h5>
                <p class="text-muted">
                    Encuentra el alojamiento perfecto para tu próxima aventura.
                    Selecciona, reserva y disfruta de experiencias únicas.
                </p>
            </div>
            <div class="col-md-3">
                <h6 class="mb-3">Enlaces Rápidos</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="text-muted text-decoration-none">Inicio</a></li>
                    <?php if (!isset($_SESSION['usuario_id'])): ?>
                        <li><a href="index.php?route=auth&action=login" class="text-muted text-decoration-none">Iniciar Sesión</a></li>
                        <li><a href="index.php?route=auth&action=register" class="text-muted text-decoration-none">Registrarse</a></li>
                    <?php else: ?>
                        <li><a href="index.php?route=user&action=dashboard" class="text-muted text-decoration-none">Mi Cuenta</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="mb-3">Contacto</h6>
                <p class="text-muted mb-1">
                    <i class="fas fa-envelope me-2"></i>info@alojamientos.com
                </p>
                <p class="text-muted mb-1">
                    <i class="fas fa-phone me-2"></i>+503 2000-0000
                </p>
                <p class="text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i>San Salvador, El Salvador
                </p>
            </div>
        </div>
        <hr class="my-4" style="border-color: #374151;">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="text-muted mb-0">
                    &copy; <?php echo date('Y'); ?> Alojamientos App. Todos los derechos reservados.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="social-links">
                    <a href="#" class="text-muted me-3 text-decoration-none">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-muted me-3 text-decoration-none">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-muted me-3 text-decoration-none">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-muted text-decoration-none">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Animaciones suaves para las cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');

        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '0';
                    entry.target.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        entry.target.style.transition = 'all 0.6s ease';
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, 100);

                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        cards.forEach(card => {
            observer.observe(card);
        });

        // Confirmación para eliminar alojamientos
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!confirm('¿Estás seguro de que deseas eliminar este alojamiento de tu cuenta?')) {
                    e.preventDefault();
                }
            });
        });

        // Auto-hide alerts después de 5 segundos
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'all 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });

    // Validación de formularios
    function validateForm(form) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });

        return isValid;
    }

    // Agregar validación a todos los formularios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html>