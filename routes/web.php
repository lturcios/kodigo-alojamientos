<?php
session_start();

spl_autoload_register(function ($class) {
    $directories = ['controllers', 'models', 'config'];
    foreach ($directories as $dir) {
        $file = __DIR__ . '/' . $dir . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }
});

// Router
$request = isset($_GET['route']) ? $_GET['route'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

try {
    switch ($request) {
        case 'home':
            $controller = new HomeController();
            $controller->index();
            break;

        case 'auth':
            $controller = new AuthController();
            switch ($action) {
                case 'login':
                    $controller->login();
                    break;
                case 'register':
                    $controller->register();
                    break;
                case 'logout':
                    $controller->logout();
                    break;
                default:
                    $controller->login();
            }
            break;

        case 'user':
            $controller = new UserController();
            switch ($action) {
                case 'dashboard':
                    $controller->dashboard();
                    break;
                case 'select':
                    $controller->selectAlojamiento();
                    break;
                case 'remove':
                    $controller->removeAlojamiento();
                    break;
                default:
                    $controller->dashboard();
            }
            break;

        case 'admin':
            $controller = new AdminController();
            switch ($action) {
                case 'dashboard':
                    $controller->dashboard();
                    break;
                case 'add':
                    $controller->addAlojamiento();
                    break;
                default:
                    $controller->dashboard();
            }
            break;

        default:
            $controller = new HomeController();
            $controller->index();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>