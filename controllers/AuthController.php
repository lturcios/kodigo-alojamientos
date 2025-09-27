<?php
class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $error = 'Por favor, complete todos los campos.';
            } else {
                $usuario = $this->usuarioModel->autenticar($email, $password);

                if ($usuario) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    $_SESSION['usuario_tipo'] = $usuario['tipo'];

                    // Redirigir según el tipo de usuario
                    if ($usuario['tipo'] === 'admin') {
                        header('Location: index.php?route=admin&action=dashboard');
                    } else {
                        header('Location: index.php?route=user&action=dashboard');
                    }
                    exit;
                } else {
                    $error = 'Credenciales inválidas.';
                }
            }
        }

        $data = [
            'title' => 'Iniciar Sesión',
            'error' => $error
        ];

        $this->render('auth/login', $data);
    }

    public function register() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Validaciones
            if (empty($nombre) || empty($email) || empty($password) || empty($confirmPassword)) {
                $error = 'Por favor, complete todos los campos.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Por favor, ingrese un email válido.';
            } elseif (strlen($password) < 6) {
                $error = 'La contraseña debe tener al menos 6 caracteres.';
            } elseif ($password !== $confirmPassword) {
                $error = 'Las contraseñas no coinciden.';
            } elseif ($this->usuarioModel->existeEmail($email)) {
                $error = 'Este email ya está registrado.';
            } else {
                if ($this->usuarioModel->crear($nombre, $email, $password)) {
                    $success = 'Cuenta creada exitosamente. Ahora puede iniciar sesión.';
                } else {
                    $error = 'Error al crear la cuenta. Intente nuevamente.';
                }
            }
        }

        $data = [
            'title' => 'Crear Cuenta',
            'error' => $error,
            'success' => $success
        ];

        $this->render('auth/register', $data);
    }

    public function logout() {
        session_destroy();
        header('Location: index.php');
        exit;
    }

    private function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/' . $view . '.php';
        include __DIR__ . '/../views/layouts/footer.php';
    }
}
?>