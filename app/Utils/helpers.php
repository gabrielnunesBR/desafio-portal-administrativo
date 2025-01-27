<?php

function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env não encontrado: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Ignora comentários
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        // Divide a linha na primeira ocorrência do '='
        [$key, $value] = explode('=', $line, 2);
        $key           = trim($key);
        $value         = trim($value);

        // Adiciona ao ambiente
        if (!isset($_ENV[$key]) && !isset($_SERVER[$key])) {
            putenv("$key=$value");
            $_ENV[$key]    = $value;
            $_SERVER[$key] = $value;
        }
    }
}
