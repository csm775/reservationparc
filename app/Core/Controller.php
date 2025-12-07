<?php

namespace App\Core;

class Controller
{
    protected function view(string $template, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../Views/layout.php';
        require __DIR__ . '/../Views/' . $template . '.php';
    }
}
