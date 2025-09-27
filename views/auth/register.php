<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="bg-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user-plus text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h2 class="fw-bold text-success">Crear Cuenta</h2>
                        <p class="text-muted">Únete y comienza a explorar alojamientos</p>
                    </div>

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
                            <div class="mt-2">
                                <a href="index.php?route=auth&action=login" class="btn btn-sm btn-success">
                                    Ir a Iniciar Sesión
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?route=auth&action=register" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold">
                                <i class="fas fa-user me-2 text-success"></i>Nombre Completo
                            </label>
                            <input type="text"
                                   class="form-control form-control-lg"
                                   id="nombre"
                                   name="nombre"
                                   required
                                   value="<?php echo htmlspecialchars(isset($_POST['nombre']) ? $_POST['nombre'] : ''); ?>"
                                   placeholder="Tu nombre completo">
                            <div class="invalid-feedback">
                                Por favor, ingresa tu nombre.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-2 text-success"></i>Correo Electrónico
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

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-success"></i>Contraseña
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password"
                                       name="password"
                                       required
                                       minlength="6"
                                       placeholder="Mínimo 6 caracteres">
                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">
                                La contraseña debe tener al menos 6 caracteres.
                            </div>
                            <div class="password-strength mt-2">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted" id="passwordStrength"></small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold">
                                <i class="fas fa-lock me-2 text-success"></i>Confirmar Contraseña
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="confirm_password"
                                       name="confirm_password"
                                       required
                                       placeholder="Confirma tu contraseña">
                                <button class="btn btn-outline-secondary"
                                        type="button"
                                        id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">
                                Las contraseñas deben coincidir.
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Crear Cuenta
                            </button>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="text-muted mb-0">
                            ¿Ya tienes una cuenta?
                            <a href="index.php?route=auth&action=login" class="text-success text-decoration-none fw-semibold">
                                Inicia sesión aquí
                            </a>
                        </p>
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
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('confirm_password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        toggleConfirmPassword.addEventListener('click', function() {
            const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordInput.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

        // Password strength indicator
        const passwordStrength = document.getElementById('passwordStrength');
        const progressBar = document.querySelector('.progress-bar');

        function checkPasswordStrength(password) {
            let strength = 0;
            let feedback = '';

            if (password.length >= 6) strength += 1;
            if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
            if (password.match(/\d/)) strength += 1;
            if (password.match(/[^a-zA-Z\d]/)) strength += 1;

            switch (strength) {
                case 0:
                case 1:
                    progressBar.style.width = '25%';
                    progressBar.className = 'progress-bar bg-danger';
                    feedback = 'Muy débil';
                    break;
                case 2:
                    progressBar.style.width = '50%';
                    progressBar.className = 'progress-bar bg-warning';
                    feedback = 'Débil';
                    break;
                case 3:
                    progressBar.style.width = '75%';
                    progressBar.className = 'progress-bar bg-info';
                    feedback = 'Buena';
                    break;
                case 4:
                    progressBar.style.width = '100%';
                    progressBar.className = 'progress-bar bg-success';
                    feedback = 'Fuerte';
                    break;
            }

            passwordStrength.textContent = feedback;
        }

        passwordInput.addEventListener('input', function() {
            checkPasswordStrength(this.value);
            clearError(this);

            // Check confirm password match
            if (confirmPasswordInput.value && this.value !== confirmPasswordInput.value) {
                showError(confirmPasswordInput, 'Las contraseñas no coinciden.');
            } else if (confirmPasswordInput.value) {
                clearError(confirmPasswordInput);
            }
        });

        // Form validation
        const form = document.querySelector('form');
        const nombreInput = document.getElementById('nombre');
        const emailInput = document.getElementById('email');

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

        // Real-time validation
        nombreInput.addEventListener('input', function() {
            clearError(this);
        });

        emailInput.addEventListener('input', function() {
            clearError(this);
            if (this.value && !validateEmail(this.value)) {
                showError(this, 'Por favor, ingresa un email válido.');
            }
        });

        confirmPasswordInput.addEventListener('input', function() {
            clearError(this);
            if (this.value && this.value !== passwordInput.value) {
                showError(this, 'Las contraseñas no coinciden.');
            }
        });

        // Form submission validation
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate nombre
            if (!nombreInput.value.trim()) {
                showError(nombreInput, 'El nombre es requerido.');
                isValid = false;
            } else {
                clearError(nombreInput);
            }

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
            } else if (passwordInput.value.length < 6) {
                showError(passwordInput, 'La contraseña debe tener al menos 6 caracteres.');
                isValid = false;
            } else {
                clearError(passwordInput);
            }

            // Validate confirm password
            if (!confirmPasswordInput.value) {
                showError(confirmPasswordInput, 'Debes confirmar la contraseña.');
                isValid = false;
            } else if (confirmPasswordInput.value !== passwordInput.value) {
                showError(confirmPasswordInput, 'Las contraseñas no coinciden.');
                isValid = false;
            } else {
                clearError(confirmPasswordInput);
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    });
</script>