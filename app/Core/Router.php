<?php
namespace App\Core;

class Router {
    /**
     * Jalankan route berdasarkan parameter ?r=controller/action (default: home/index).
     */
    public static function dispatch(string $route = 'home/index', string $baseUrl = '.'): void {
        $parts = array_values(array_filter(explode('/', trim($route, '/'))));
        $controllerKey = strtolower($parts[0] ?? 'home');
        $action = $parts[1] ?? 'index';

        $map = [
            'home' => \App\Controllers\HomeController::class,
            'auth' => \App\Controllers\AuthController::class,
            'kursus' => \App\Controllers\KursusController::class,
            'dashboard' => \App\Controllers\DashboardController::class,
            'sertifikat' => \App\Controllers\SertifikatController::class,
            'admin' => \App\Controllers\AdminController::class,
            'pengelola' => \App\Controllers\AdminController::class,
            'api' => \App\Controllers\ApiController::class,
        ];

        $class = $map[$controllerKey] ?? \App\Controllers\HomeController::class;
        $controller = new $class();

        if ($controller instanceof \App\Controllers\ApiController) {
            $controller->handle();
            return;
        }

        if (!method_exists($controller, $action)) {
            $action = 'index';
        }

        $controller->$action($baseUrl);
    }
}
