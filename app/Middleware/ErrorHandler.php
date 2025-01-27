<?php

namespace App\Middleware;

class ErrorHandler
{
    public static function register()
    {
        // Configurar um manipulador de exceções personalizadas
        set_exception_handler([self::class, 'handleException']);

        // Configurar um manipulador de erros PHP
        set_error_handler([self::class, 'handleError']);

        // Configurar um manipulador para shutdown (ex.: erros fatais)
        register_shutdown_function([self::class, 'handleShutdown']);
    }

    public static function handleException(\Throwable $e)
    {
        http_response_code(500);

        self::renderErrorTemplate($e->getMessage(), $e->getFile(), $e->getLine(), $e->getTraceAsString());
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        http_response_code(500);
        self::renderErrorTemplate($errstr, $errfile, $errline);
    }

    public static function handleShutdown()
    {
        $error = error_get_last();
        if ($error !== null) {
            http_response_code(500);
            self::renderErrorTemplate($error['message'], $error['file'], $error['line']);
        }
    }

    private static function renderErrorTemplate($message, $file, $line, $trace = '')
    {
        // $environment = getenv('APP_ENV') ?: 'production';

        // if ($environment === 'production') {
        //     $message = 'Ocorreu um erro no servidor. Tente novamente mais tarde.';
        //     $file = $line = $trace = '';
        // }

        include dirname(__DIR__) . '/Views/errors/error.php';
    }
}
