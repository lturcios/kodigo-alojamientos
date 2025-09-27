<?php
class UserController {
    private $alojamientoModel;
    private $usuarioAlojamientoModel;

    public function __construct() {
        $this->alojamientoModel = new Alojamiento();
        $this->usuarioAlojamientoModel = new UsuarioAlojamiento();

        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?route=auth&action=login');
            exit;
        }

        // Verificar que no sea admin
        if (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin') {
            header('Location: index.php?route=admin&action=dashboard');
            exit;
        }
    }

    public function dashboard() {
        $usuarioId = $_SESSION['usuario_id'];

        // Obtener alojamientos seleccionados por el usuario
        $alojamientosSeleccionados = $this->alojamientoModel->obtenerAlojamientosUsuario($usuarioId);

        // Obtener alojamientos disponibles (no seleccionados)
        $alojamientosDisponibles = $this->alojamientoModel->obtenerAlojamientosDisponibles($usuarioId);

        $data = [
            'title' => 'Mi Cuenta - Alojamientos',
            'alojamientos_seleccionados' => $alojamientosSeleccionados,
            'alojamientos_disponibles' => $alojamientosDisponibles,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ];

        $this->render('user/dashboard', $data);
    }

    public function selectAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alojamiento_id'])) {
            $usuarioId = $_SESSION['usuario_id'];
            $alojamientoId = (int)$_POST['alojamiento_id'];

            // Verificar que el alojamiento existe
            $alojamiento = $this->alojamientoModel->obtenerPorId($alojamientoId);

            if ($alojamiento) {
                // Verificar que no esté ya seleccionado
                if (!$this->usuarioAlojamientoModel->yaSeleccionado($usuarioId, $alojamientoId)) {
                    if ($this->usuarioAlojamientoModel->seleccionar($usuarioId, $alojamientoId)) {
                        $_SESSION['success'] = 'Alojamiento agregado a tu cuenta exitosamente.';
                    } else {
                        $_SESSION['error'] = 'Error al agregar el alojamiento.';
                    }
                } else {
                    $_SESSION['error'] = 'Este alojamiento ya está en tu cuenta.';
                }
            } else {
                $_SESSION['error'] = 'Alojamiento no encontrado.';
            }
        }

        header('Location: index.php?route=user&action=dashboard');
        exit;
    }

    public function removeAlojamiento() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alojamiento_id'])) {
            $usuarioId = $_SESSION['usuario_id'];
            $alojamientoId = (int)$_POST['alojamiento_id'];

            if ($this->usuarioAlojamientoModel->eliminar($usuarioId, $alojamientoId)) {
                $_SESSION['success'] = 'Alojamiento eliminado de tu cuenta exitosamente.';
            } else {
                $_SESSION['error'] = 'Error al eliminar el alojamiento.';
            }
        }

        header('Location: index.php?route=user&action=dashboard');
        exit;
    }

    private function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/' . $view . '.php';
        include __DIR__ . '/../views/layouts/footer.php';
    }
}