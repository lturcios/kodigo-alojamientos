<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-sign-in-alt text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Iniciar Sesión</h2>
                        <p class="text-muted">Accede a tu cuenta para continuar</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?route=auth&action=login" novalidate>
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-primary"></i>Correo Electrónico
                            </label>
                            <input type="email"
                                   class="form-control form-control-lg"
                                   id="email"
                                   name="email"
                                   required
                                   value="<?php echo htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : ''); ?>"
                                   placeholder="tu@email.com">
                            <div class="invalid-feedback">
                                Por favor, ingresa un email válido.
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-primary"></i>Contraseña
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password"
                                       name="password"
                                       required
                                       placeholder="Tu contraseña">
                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">
                                Por favor, ingresa tu contraseña.
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            ¿No tienes una cuenta?
                            <a href="index.php?route=auth&action=register" class="text-primary text-decoration-none fw-semibold">
                                Regístrate aquí
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Credenciales de prueba -->
            <div class="card mt-4 border-info">
                <div class="card-body">
                    <h6 class="card-title text-info">
                        <i class="fas fa-info-circle me-2"></i>Credenciales de Prueba
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Administrador:</strong></p>
                            <small class="text-muted">admin@admin.com</small><br>
                            <small class="text-muted">password</small>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Usuario Normal:</strong></p>
                            <small class="text-muted">Crear nueva cuenta →</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        // Form validation
        const form = document.querySelector('form');
        const emailInput = document.getElementById('email');
        // const passwordInput = document.getElementById('password');

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

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

        emailInput.addEventListener('input', function() {
            clearError(this);
            if (this.value && !validateEmail(this.value)) {
                showError(this, 'Por favor, ingresa un email válido.');
            }
        });

        passwordInput.addEventListener('input', function() {
            clearError(this);
        });

        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate email
            if (!emailInput.value) {
                showError(emailInput, 'El email es requerido.');
                isValid = false;
            } else if (!validateEmail(emailInput.value)) {
                showError(emailInput, 'Por favor, ingresa un email válido.');
                isValid = false;
            } else {
                clearError(emailInput);
            }

            // Validate password
            if (!passwordInput.value) {
                showError(passwordInput, 'La contraseña es requerida.');
                isValid = false;
            } else {
                clearError(passwordInput);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>