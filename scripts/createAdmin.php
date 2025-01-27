<?php

use App\Factories\DatabaseFactory;
use App\Repositories\AdminRepository;
use App\Services\AdminService;

require_once dirname(__DIR__) . '/vendor/autoload.php';

require_once dirname(__DIR__) . '/app/Utils/helpers.php';
loadEnv(dirname(__DIR__) . '/.env');

$config = include dirname(__DIR__) . '/config/config.php';

$adminName     = getenv('DEFAULT_ADMIN_NAME');
$adminEmail    = getenv('DEFAULT_ADMIN_EMAIL');
$adminPassword = getenv('DEFAULT_ADMIN_PASSWORD');

if (!$adminEmail || !$adminPassword) {
    die('Erro: Credenciais do administrador não definidas nas variáveis de ambiente.');
}

$db = DatabaseFactory::create($config['db']);

$adminService = new AdminService(new AdminRepository($db));

$adminExists = $adminService->getAdminByEmail($adminEmail);

if ($adminExists) {
    echo "O administrador padrão já existe.\n";
} else {

    $adminService->createAdmin(
        [
            'nome'  => $adminName,
            'email' => $adminEmail,
            'senha' => $adminPassword,
        ]
    );

    echo "Administrador padrão criado com sucesso.\n";
}
