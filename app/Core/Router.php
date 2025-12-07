<?php

namespace App\Core;

class Router
{
    public function handleRequest(): void
    {
        $url = $_GET['url'] ?? '';

        $params = explode('/', trim($url, '/'));

        $controllerName = !empty($params[0]) ? ucfirst($params[0]) . 'Controller' : 'ActivityController';
        $method = $params[1] ?? 'index';
        $id = $params[2] ?? null;

        $controllerClass = "App\\Controllers\\$controllerName";

        if (!class_exists($controllerClass)) {
            http_response_code(404);
            echo "Page 404 - Contrôleur introuvable";
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $method)) {
            http_response_code(404);
            echo "Page 404 - Méthode introuvable";
            return;
        }

        $id ? $controller->$method((int)$id) : $controller->$method();
    }
}
