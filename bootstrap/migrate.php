<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = include dirname(__DIR__) . '/config/config.php';

use App\Factories\DatabaseFactory;
use App\Helpers\Migrate;

$db = DatabaseFactory::create($config['db']);

$migrate = new Migrate($db);
$migrate->run();
