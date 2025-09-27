<?php
class AdminController {
    private $alojamientoModel;
    private $usuarioModel;

    public function __construct() {
        $this->alojamientoModel = new Alojamiento();
        $this->usuarioModel = new Usuario();

        // Verificar autenticación
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?route=auth&action=login');
            exit;
        }

        // Verificar que sea admin
        if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'admin') {
            header('Location: index.php?route=user&action=dashboard');
            exit;
        }
    }

    public function dashboard() {
        // Obtener todos los alojamientos
        $alojamientos = $this->alojamientoModel->obtenerTodos();

        $data = [
            'title' => 'Panel de Administrador',
            'alojamientos' => $alojamientos,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ];

        $this->render('admin/dashboard', $data);
    }

    public function addAlojamiento() {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $descripcion = trim($_POST['descripcion']);
            $precio = floatval($_POST['precio']);
            $ubicacion = trim($_POST['ubicacion']);
            $imagen = trim($_POST['imagen']);

            // Validaciones
            if (empty($nombre) || empty($descripcion) || empty($ubicacion)) {
                $error = 'Por favor, complete todos los campos obligatorios.';
            } elseif ($precio <= 0) {
                $error = 'El precio debe ser mayor a 0.';
            } else {
                // Validar URL de imagen si se proporciona
                if (!empty($imagen) && !filter_var($imagen, FILTER_VALIDATE_URL)) {
                    $error = 'Por favor, ingrese una URL válida para la imagen.';
                } else {
                    // Si no se proporciona imagen, usar una por defecto
                    if (empty($imagen)) {
                        $imagen = 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop';
                    }

                    if ($this->alojamientoModel->crear($nombre, $descripcion, $precio, $ubicacion, $imagen)) {
                        $success = 'Alojamiento agregado exitosamente.';
                        // Limpiar formulario
                        $_POST = [];
                    } else {
                        $error = 'Error al agregar el alojamiento. Intente nuevamente.';
                    }
                }
            }
        }

        // Obtener alojamientos actuales para mostrar
        $alojamientos = $this->alojamientoModel->obtenerTodos();

        $data = [
            'title' => 'Panel de Administrador - Agregar Alojamiento',
            'error' => $error,
            'success' => $success,
            'alojamientos' => $alojamientos,
            'usuario_nombre' => $_SESSION['usuario_nombre']
        ];

        $this->render('admin/dashboard', $data);
    }

    private function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/layouts/header.php';
        include __DIR__ . '/../views/' . $view . '.php';
        include __DIR__ . '/../views/layouts/footer.php';
    }
}
?>