<?php
class HomeController {
    private $alojamientoModel;

    public function __construct() {
        $this->alojamientoModel = new Alojamiento();
    }

    public function index() {
        // Obtener todos los alojamientos para mostrar en la landing page
        $alojamientos = $this->alojamientoModel->obtenerTodos();

        // Datos para la vista
        $data = [
            'title' => 'Alojamientos - Encuentra tu lugar perfecto',
            'alojamientos' => $alojamientos,
            'usuario_logueado' => isset($_SESSION['usuario_id'])
        ];

        $this->render('home/index', $data);
    }

    private function render($view, $data = []) {
        // Extraer variables para la vista
        extract($data);

        // Incluir header
        include __DIR__ . '/../views/layouts/header.php';

        // Incluir la vista específica
        include __DIR__ . '/../views/' . $view . '.php';

        // Incluir footer
        include __DIR__ . '/../views/layouts/footer.php';
    }
}
?>