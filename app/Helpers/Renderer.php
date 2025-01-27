<?php

namespace App\Helpers;

class Renderer
{
    public static function render(string $viewPath, array $data = [])
    {
        extract($data); // Transforma o array em variáveis

        $viewFile = dirname(__DIR__) . "/Views/" . $viewPath . ".php";

        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new \Exception("View '{$viewPath}' não encontrada.");
        }
    }
}
