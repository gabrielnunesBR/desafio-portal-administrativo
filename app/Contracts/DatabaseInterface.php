<?php

namespace App\Contracts;

interface DatabaseInterface
{
    public function query(string $query, array $params = []);
    public function fetchAll(string $query, array $params = []);
    public function fetch(string $query, array $params = []);
    public function execute(string $query, array $params = []);
    public function beginTransaction();
    public function commit();
    public function rollBack();
    public function lastInsertId();
}
