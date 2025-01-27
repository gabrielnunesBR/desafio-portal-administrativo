<?php

namespace App\Factories;

use App\Contracts\DatabaseInterface;
use App\Database\MySQLDatabase;

class DatabaseFactory
{
    public static function create(array $config): DatabaseInterface
    {
        if ($config['driver'] === 'mysql') {
            return new MySQLDatabase(
                $config['host'],
                $config['dbname'],
                $config['user'],
                $config['password']
            );
        }

        throw new \Exception("Driver de banco de dados não suportado.");
    }
}
