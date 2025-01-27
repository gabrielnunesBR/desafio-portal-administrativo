<?php

namespace App\Database;

use App\Contracts\DatabaseInterface;
use PDO;

class MySQLDatabase implements DatabaseInterface
{
    private $connection;

    public function __construct($host, $dbname, $user, $password)
    {
        $this->connection = new PDO(
            "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
            $user,
            $password
        );

        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll(string $query, array $params = [])
    {
        return $this->query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch(string $query, array $params = [])
    {
        return $this->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(string $query, array $params = [])
    {
        return $this->query($query, $params)->rowCount();
    }

    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }

    public function commit()
    {
        $this->connection->commit();
    }

    public function rollBack()
    {
        $this->connection->rollBack();
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
