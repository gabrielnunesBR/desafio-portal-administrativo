<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Helpers\Router;
use App\Factories\DatabaseFactory;
use App\Middleware\ErrorHandler;

ErrorHandler::register();

// Configurações gerais
$config = include dirname(__DIR__) . '/config/config.php';

// Inicializa a conexão com o banco de dados
$db = DatabaseFactory::create($config['db']);

// Inicializa o roteador
$router = new Router($db);

require_once dirname(__DIR__) . '/routes/web.php';

return $router;
